<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    @if(__('generic.direction') == 'ltr')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/app-rtl.css') }}" rel="stylesheet">
    @endif
</head>
<body dir="{{ __('generic.direction') == 'rtl' ? 'rtl' : 'lrt' }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('layout.header.brand') }}
                    {{--{{ config('app.name', 'Laravel') }}--}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('layout.header.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('layout.header.register') }}</a>
                                </li>
                            @endif
                            <li class="nav-item" ><a class="dropdown-item text-center lang {{ getLocale() == 'fa' ? ' active disabled' : '' }}"
                                                     href="{{ route('setLocale', 'fa') }}">فا</a></li>
                            <li class="nav-item" ><a class="dropdown-item text-center lang {{ getLocale() == 'en' ? ' active disabled' : '' }}"
                                                     href="{{ route('setLocale', 'en') }}" >en</a></li>
                        @else
                            @if(auth()->guard('user')->check())
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('user')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('layout.header.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-center lang {{ getLocale() == 'en' ? ' active disabled' : '' }}"
                                       href="{{ route('setLocale', 'en') }}" >en</a>
                                    <a class="dropdown-item text-center lang {{ getLocale() == 'fa' ? ' active disabled' : '' }}"
                                       href="{{ route('setLocale', 'fa') }}">فا</a>
                                </div>
                            </li>
                            @else
                                <li class="nav-item" ><a class="dropdown-item text-center lang {{ getLocale() == 'en' ? ' active disabled' : '' }}"
                                                         href="{{ route('setLocale', 'en') }}" >en</a></li>
                                <li class="nav-item" ><a class="dropdown-item text-center lang {{ getLocale() == 'fa' ? ' active disabled' : '' }}"
                                                         href="{{ route('setLocale', 'fa') }}">فا</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('layout.header.login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('layout.header.register') }}</a>
                                    </li>
                                @endif
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    @yield('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
