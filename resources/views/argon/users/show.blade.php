@extends('argon.layouts.argon')


@section('title')
    Run Winter -  Профиль {{ $user->name }} {{ $user->surname }}
@endsection


@section('content')
    <section class="section bg-secondary">
        <div class="container">
            <div class="card card-profile shadow">
                <div class="row p-4">
                    <div class="col-md-3">
                        <div class="card-profile-image">
                            <a href="javascript:;">
                                @if($user->photo_url)
                                    <img src="{{ $user->photo_url }}" class="img-fluid rounded">
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>{{ $user->name }} {{ $user->surname }}</h3>
                        <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>{{ $user->city }}, {{ $user->country }}</div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info">
                                    <div class="icon icon-sm icon-shape icon-shape-primary shadow rounded-circle">
                                        <i class="ni ni-user-run"></i>
                                    </div>
                                    <h6 class="info-title text-uppercase text-primary">
                                        <small>{{ $user->activities->count() }} пробежек</small>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info">
                                    <div class="icon icon-sm icon-shape icon-shape-success shadow rounded-circle">
                                        <i class="fa fa-android"></i>
                                    </div>
                                    <h6 class="info-title text-uppercase text-success">
                                        <small>{{ $user->distance }} км</small>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info">
                                    <div class="icon icon-sm icon-shape icon-shape-warning shadow rounded-circle">
                                        <i class="fa fa-dashcube"></i>
                                    </div>
                                    <h6 class="info-title text-uppercase text-warning">
                                        <small>{{ $user->uniqueDates }} дней</small>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        @if($user->strava_id)
                            <a href="https://strava.com/athletes/{{ $user->strava_id }}" target="_blank" class="btn btn-sm btn-outline-warning btn-block">STRAVA Профиль</a><br>
                        @endif

                        @if($user->id === auth()->user()->id)
                            <a href="{{ route('users.edit', auth()->user()->id) }}" class="btn btn-sm btn-outline-default btn-block">Ред. Профиль</a><br>
                            <a href="{{ route('activities.create') }}" class="btn btn-sm btn-block btn-neutral">Добавить пробежку</a><br>

                            @if(!$user->strava_id)
                                    <a href="{{ route('auth.strava.redirect') }}" class="btn btn-sm btn-outline-warning btn-block">Подключить STRAVA</a><br>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-12">
                        @include('argon.activities.partials.table', [
                            'activities' => $user->activities,
                            'showActions' => false,
                        ])

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
