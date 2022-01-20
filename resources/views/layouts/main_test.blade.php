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

</head>
<body>
<div id="app">
    <progressbar-component></progressbar-component>
</div>
</body>
</html>
