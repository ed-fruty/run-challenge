
<table class="table table-hover table-neutral table-bordered datatable">
    <thead>
    <tr>
        <th>Дата</th>
        <th>Дистанция</th>
        <th>Темп</th>
        <th>Источник</th>
        <th>Скришнот</th>
        <th>Время</th>
        @if($showActions)
        <th>Действия</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($activities as $activity)
        <tr>
            <td>{{ $activity->start_date->format('d.m.Y') }}</td>
            <td>{{ $activity->getDistanceInKm() }} км</td>
            <td>{{ $activity->getTemp() }}</td>
            <td>
                @if($activity->isManual())
                    Загружена вручную
                @else
                    Загружено автоматически
                @endif
            </td>
            <td>
                @if($activity->image)
                    <img src="{{ $activity->getFullImage() }}" class="img-fluid img-thumbnail rounded" />
                @else
                    Нет изображения
                @endif
            </td>
            <td>
                {{ now()->addSeconds($activity->strava_moving_time)->diffInMinutes(now()) }}
                мин.
            </td>
            @if($showActions)
            <td>
                <button
                    href="{{ route('activities.destroy', $activity->id) }}"
                    class="btn btn-danger btn-sm"
                    onclick="if(confirm('Вы точно хотите удалить пробежку?')) document.getElementById('activity-{{ $activity->id }}').submit();"
                >
                    <i class="fa fa-trash-o"></i>
                    Удалить
                </button>

                <form id="activity-{{ $activity->id }}" action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="d-none">
                    @method('delete')
                    @csrf
                </form>
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>


@section('js')
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable({
                language: {
                    url: "http://cdn.datatables.net/plug-ins/1.10.20/i18n/Russian.json"
                },
                order: [[ 0, "desc" ]],
                "info":     false,
                "paging":   false,
            });
        } );
    </script>
@endsection
