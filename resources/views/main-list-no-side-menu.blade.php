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
    <div class="flex top-box">
        <div>
            <img src="{{URL::asset("images/logo_lion_lifi.svg")}}" alt="logo_lifi">
        </div>
        <div class="col-lg-2 col-xs-8">
            <div class="info-box bg-aqua">
            <span class="info-box-icon">
                <i class="fas fa-mobile-alt"></i>
            </span>
                <div class="info-box-content">
                    <span class="info-box-text"><a href="#">Sessions</a></span>
                    <span class="info-box-number">1983</span>
                    <span class="info-box-text-1"><a href="#">Last Day: 71</a></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-8">
            <div class="info-box bg-aqua">
            <span class="info-box-icon">
                <i class="fas fa-users"></i>
            </span>
                <div class="info-box-content">
                    <span class="info-box-text"><a href="#">Unique Users</a></span>
                    <span class="info-box-number">180</span>
                    <span class="info-box-text-1"><a href="#">Last Day: 1</a></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-8">
            <div class="info-box bg-aqua">
            <span class="info-box-icon">
                <i class="fas fa-chart-pie"></i>
            </span>
                <div class="info-box-content">
                    <span class="info-box-text"><a href="#">Data Usage</a></span>
                    <span class="info-box-number">384 GBs</span>
                    <span class="info-box-text-1"><a href="#">Last Day: 15 GBs</a></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xs-8">
            <div class="info-box bg-aqua">
            <span class="info-box-icon">
                <i class="far fa-clock"></i>
            </span>
                <div class="info-box-content">
                    <span class="info-box-text"><a href="#">Time Spent</a></span>
                    <span class="info-box-number">943 Hrs</span>
                    <span class="info-box-text-1"><a href="#">Last Day: 28 Hrs</a></span>
                </div>
            </div>
        </div>
    </div>

@endsection
