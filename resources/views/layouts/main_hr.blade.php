<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

<!-- Fonts -->
    <script src="https://kit.fontawesome.com/9861d16a15.js" crossorigin="anonymous"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @laravelViewsStyles
    @livewireStyles
</head>
<body>
<div id="app">
    @yield('header')
    @yield('content')
    <!-- Bootstrap row -->
        <div class="row-p">
            <div class="row" id="body-row">
                @yield('sidemenu')
                <div class="main_hr_container">
                    @yield('container')
                </div>
            </div>
        </div>
 </div>
@laravelViewsScripts
</body>
</html>
