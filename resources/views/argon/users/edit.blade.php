@extends('argon.layouts.argon')


@section('title')
    Run Winter - Редактирование профиля
@endsection


@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Редактирование профиля') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', auth()->user()->id) }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="off" autofocus placeholder="Иван">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname', $user->surname) }}" required autocomplete="off" placeholder="Иванов">

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Страна') }}</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country', $user->country) }}" required autocomplete="off" placeholder="Украина">

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Город') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', $user->city) }}" required autocomplete="off" placeholder="Одесса">

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="photo_url" class="col-md-4 col-form-label text-md-right">{{ __('Аватар') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="file" class="form-control @error('photo_url') is-invalid @enderror" name="photo_url" value="{{ old('photo_url', $user->city) }}">

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    @if($user->photo_url)
                                        <img src="{{ $user->photo_url }}" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Сохранить') }}
                                    </button>
                                    <a class="btn btn-outline-default" href="{{ route('users.show', auth()->user()->id) }}">
                                        {{ __('Назад') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
