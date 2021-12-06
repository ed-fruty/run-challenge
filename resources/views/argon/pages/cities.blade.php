@extends('argon.layouts.argon')

@section('title')
    Run Winter - Города
@endsection

@section('content')
        <div class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 text-center">
                        <h2 class="display-3">Города</h2>
                        <table class="table table-hover table-borderless datatable">
                            <thead>
                            <tr>
                                <th>Страна</th>
                                <th>Город</th>
                                <th>Дистанция</th>
                                <th>Пробежек</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>{{ $city->country ?? 'Не указано' }}</td>
                                    <td>{{ $city->city ?? 'Не указано' }}</td>
                                    <td>{{ $city->distance }} км</td>
                                    <td>{{ $city->activities_count }}</td>
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
                order: [[ 2, "asc" ]],
                "info":     false,
                "paging":   false,
            });
        } );
    </script>
@endsection
