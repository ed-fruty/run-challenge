
<table class="table table-hover table-neutral table-bordered datatable">
    <thead>
    <tr>
        <th>Дата</th>
        <th>Дистанция</th>
        <th>Темп</th>
        <th>Время</th>
        <th>Скришнот</th>
        <th>Источник</th>
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
                {{ now()->addSeconds($activity->strava_moving_time)->diffInMinutes(now()) }}
                мин.
            </td>
            <td>
                @if($activity->image)
                    <a href="{{ $activity->getFullImage() }}" target="_blank">
                        <img src="{{ $activity->getFullImage() }}"
                             class="img-fluid img-thumbnail rounded shadow"
                             style="max-width: 150px; max-height: 150px;"
                             alt="Изображение"
                        />
                    </a>
                @else
                    Нет изображения
                @endif
            </td>
            <td>
                @if($activity->isManual())
                    <button class="btn btn-outline-primary" disabled>
                        <i class="fa fa-id-card-o"></i>
                    </button>
                @else
                    <a href="https://strava.com/activities/{{ $activity->strava_id }}" class="btn btn-sm btn-outline-warning" target="_blank">
                        <img src="https://cdn.iconscout.com/icon/free/png-256/strava-2752062-2284879.png" alt="Автоматически" class="img-fluid avatar avatar-sm">
                    </a>
                @endif
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
