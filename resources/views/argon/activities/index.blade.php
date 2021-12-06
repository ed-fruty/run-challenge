@extends('argon.layouts.argon')


@section('title')
   Run Winter - Мои пробежки
@endsection


@section('content')
    <div class="section">
        <div class="container py-4">
            <div class="card">
                <div class="card-header">Мои пробежки</div>
                <div class="card-body">
                    @if($activities->isEmpty())
                        <div class="alert alert-warning">У вас пока еще нет пробежек.</div>
                        <a class="btn btn-block btn-neutral" href="{{ route('activities.create') }}">Добавить пробежку</a>
                    @else
                        <a class="btn btn-block btn-neutral" href="{{ route('activities.create') }}">Добавить пробежку</a>
                        <hr>

                        {{ $activities->links() }}
                        @include('argon.activities.partials.table', [
                            'activities' => $activities,
                            'showActions' => true,
                        ])
                        {{ $activities->links() }}

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
