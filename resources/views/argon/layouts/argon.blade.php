<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @section('title')
            Run winter
        @show
    </title>
    @include('argon.partials.head')
</head>
<body>
@include('argon.partials.navbar')
    @if (session('status'))
        <div class="container py-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @yield('content')
@include('argon.partials.footer')
@include('argon.partials.footer-js')
</body>

</html>
