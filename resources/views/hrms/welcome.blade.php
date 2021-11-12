@extends('layouts.main_hr')
@extends('includes.header')
@section('container_no_margin')
   {{-- <div class="w-full-screen bg-black pd-0">
        <img src="{{ URL::asset("images/welcome.jpg") }}" alt="bg">
        <div class="col">
            <div class="logo-w w-screen-text">
                <div class="logo-row">
                    <img class="logo-white" src="{{ URL::asset("images/logo.png") }}" alt="logo">
                </div>
                <h1>Welcome</h1>
                <div class="mt-5">
                    <ul class="li-margin text-decoration-none flex justify-content-center">
                        <li><a href="{{ route('hr_dashboard') }}"><i class="fas fa-arrow-left"></i>Dashboard</a></li>
                        <li><a href="#">Profile<i class="fas fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>--}}

    <div class="bg">
        <img src="{{ URL::asset("images/background_rr.jpg") }}" alt="bg">
        <div class="bg-image"></div>
        <div class="center text-white"><h5>Welcome</h5></div>
        <div class="center text-white mt-5">
            <ul class="li-margin text-decoration-none flex justify-content-center">
                <li><a href="{{ route('hr_dashboard') }}"><i class="fas fa-arrow-left"></i>Dashboard</a></li>
                <li><a href="#">Profile<i class="fas fa-arrow-right"></i></a></li>
            </ul>
        </div>
    </div>

@endsection
