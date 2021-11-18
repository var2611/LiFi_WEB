<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LiFi - {{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
          rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/9861d16a15.js" crossorigin="anonymous"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @laravelViewsStyles
    @livewireStyles
    @notifyCss

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
@yield('header')
@yield('content')
<!-- Bootstrap row -->
    <div class="row-p">
        @yield('container_no_margin')
        <div class="row" id="body-row">
            @yield('sidemenu')
            <div class="main_hr_container">
                @if(isset($title)||isset($add_btn_route))
                    <div class="mb-4">
                        <h1><strong>{{ $title ?? "" }}</strong></h1>
                        @if(isset($add_btn_route) && (Auth::user()->isHR() || Auth::user()->isAdmin()))
                            <a href="{{ $add_btn_route ?? '#' }}">
                                <button class="btn-plus"><i class="fas fa-plus"></i></button>
                            </a>
                        @endif
                    </div>
                @endif

                @yield('lifi_lion')

                @yield('container')
            </div>
        </div>
    </div>
    @yield('footer')
</div>
<x:notify-messages/>
@laravelViewsScripts
@notifyJs
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
</script>
</body>
</html>
