@extends('argon.layouts.argon')

@section('title')
    Run Winter - Вход
@endsection

@section('content')
<div class="wrapper">
    <section class="section section-shaped">
        <div class="shape shape-style-1 bg-gradient-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container pt-lg-7">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-white pb-2">
                            <div class="text-muted text-center mb-3"><small>Войти через</small></div>
                            <div class="text-center">
                                <a href="{{ route('auth.strava.redirect') }}" class="btn btn-outline-warning btn-icon">
                                    <span class="btn-inner--icon"><img src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/323_Strava_logo-512.png"></span>
                                    <span class="btn-inner--text">Strava</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Или заполните форму ниже</small>
                            </div>
                            @if($errors->any())
                                <div class="text-danger">
                                    <ul>
                                    {!! implode('', $errors->all('<li><small>:message</small></li>')) !!}
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}" role="form">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control"id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" type="email" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" id="password" name="password" value="{{ old('password') }}" required placeholder="Пароль" type="password">
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Запомнить меня') }}
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Войти</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
