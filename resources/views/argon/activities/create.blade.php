@extends('argon.layouts.argon')


@section('title')
    Run Winter - Добавить пробежку
@endsection


@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Добавить пробежку') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('activities.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Дистанция (км)') }}</label>

                                <div class="col-md-6">
                                    <input id="distance" type="text" class="form-control @error('distance') is-invalid @enderror" name="distance" value="{{ old('distance') }}" required autocomplete="off" autofocus placeholder="21.1">

                                    @error('distance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Дата') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="flatpickr flatpickr-input form-control  @error('distance') is-invalid @enderror" type="text" placeholder="Выберите дату..." name="start_date" value="{{ old('start_date') }}" required  >
                                    </div>
                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Скриншот') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Добавить') }}
                                    </button>
                                    <a class="btn btn-outline-default" href="{{ route('activities.index') }}">
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
