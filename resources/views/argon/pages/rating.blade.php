@extends('argon.layouts.argon')

@section('title')
    Рейтинг
@endsection

@section('content')
        <div class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 text-center">
                        <h2 class="display-3">Рейтинг</h2>
                        <table class="table table-hover table-borderless datatable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Участник</th>
                                <th>Кол-во пробежек</th>
                                <th>Дистанция</th>
                                <th>Дней</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rating as $user)
                                <tr>
                                    <td class="text-center">
                                        @if($user->photo_url)
                                            <img src="{{ $user->photo_url }}" alt="" class="avatar avatar-xs rounded-circle">
                                        @endif
                                    </td>
                                    <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-link text-primary">{{ $user->name }} {{ $user->lastname }}</a> </td>
                                    <td>{{ $user->activities->count() }}</td>
                                    <td>{{ $user->distance }} км</td>
                                    <td>{{ $user->uniqueDates }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('js')
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable({
                language: {
                    url: "http://cdn.datatables.net/plug-ins/1.10.20/i18n/Russian.json"
                },
                order: [[ 4, "desc" ]],
                "info":     false,
                "paging":   false,
            });
        } );
    </script>
@endsection
