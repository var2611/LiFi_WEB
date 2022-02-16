<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LiFi - {{ $title ?? config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
{{--    <script src="{{ asset('js/testing.js') }}" defer></script>--}}

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <div class="navbar-left">

        {{-- button for expanding nav bar --}}
        <nav-slide-button id="nav-expand-button" icon-class="accordian-right-icon"
                          style="display: none;"></nav-slide-button>

        {{-- left menu bar --}}
        <ul class="menubar">
            <li class="menu-item active">
                <a href="#">
                    <span class="icon dashboard-icon"></span>

                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

    </div>
</div>
</body>
</html>
