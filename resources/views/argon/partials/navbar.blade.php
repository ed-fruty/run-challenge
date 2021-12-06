<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
    <div class="container">
        <a class="navbar-brand mr-lg-5" href="{{ route('pages.index') }}">
            <img src="http://runwinter.com/site/site_image/rwc_blue.svg" alt="">
            RUN WINTER
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('pages.index') }}">
                            Run Winter
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item">
                    <a href="{{ route('pages.rating') }}" class="nav-link" role="button">
{{--                        <i class="ni ni-trophy"></i>--}}
                        <span class="nav-link-inner--text">Рейтинг</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.rules') }}" class="nav-link" role="button">
{{--                        <i class="ni ni-bullet-list-67"></i>--}}
                        <span class="nav-link-inner--text">Правила</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.cities') }}" class="nav-link" role="button">
{{--                        <i class="ni ni-square-pin"></i>--}}
                        <span class="nav-link-inner--text">Города</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link nav-link-icon" href="https://www.facebook.com/groups/runwinter/" target="_blank" data-toggle="tooltip" title="Follow us on Facebook">--}}
{{--                        <i class="fa fa-facebook-official"></i>--}}
{{--                        <span class="nav-link-inner--text d-lg-none">Facebook</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link nav-link-icon" href="https://t.me/runwinter" target="_blank" data-toggle="tooltip" title="Follow us on Telegram">--}}
{{--                        <i class="fa fa-telegram"></i>--}}
{{--                        <span class="nav-link-inner--text d-lg-none">Telegram</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-neutral" role="button">
                            <i class="fa fa-user-circle"></i>
                            <span class="nav-link-inner--text">Вход</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-neutral" role="button">
                            <i class="fa fa-user-plus"></i>
                            <span class="nav-link-inner--text">Регистрация</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('activities.create') }}" class="btn btn-neutral" role="button">
                            <i class="fa fa-plus"></i>
                            <span class="nav-link-inner--text">Добавить</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                            <i class="fa fa-user-o"></i>
                            <span class="nav-link-inner--text">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('activities.index') }}" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                Мои пробежки
                            </a>
                            <a href="{{ route('users.show', auth()->user()->id) }}" class="dropdown-item">
                                <i class="fa fa-address-card"></i>
                                Профиль
                            </a>
                            <a
                                href="{{ route('logout') }}"
                                class="dropdown-item"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                >
                                <i class="fa fa-sign-out"></i>
                                Выход
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
