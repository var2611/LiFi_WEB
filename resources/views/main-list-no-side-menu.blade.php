@if ($refresh ?? false)
    <?php
    $url1 = $_SERVER['REQUEST_URI'];
    header("Refresh: 120; URL=$url1");
    ?>
@endif

@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.footer')
@section('lifi_lion')
    <div>
        <img src="{{URL::asset("images/logo_lion_lifi.svg")}}" alt="logo_lifi">
    </div>
@endsection
