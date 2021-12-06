@extends('argon.layouts.argon')

@section('title')
    Рейтинг
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
                                <th class="text-center">#</th>
                                <th>Страна</th>
                                <th>Город</th>
                                <th>Дистанция</th>
                                <th>Пробежек</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $city->country ?? 'Не указано' }}</td>
                                    <td>{{ $city->city ?? 'Не указано' }}</td>
                                    <td>{{ $city->getDistanceInKm() }} км</td>
                                    <td>{{ $city->activities }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
