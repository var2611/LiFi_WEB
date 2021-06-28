@extends('layouts.main_hr')
@extends('includes.header')
@section('container')
    <div class="w-full-screen bg-black pd-0">
        <img src="{{ URL::asset("images/welcome.jpg") }}" alt="bg">
        <div class="col">
            <div class="w-screen-text">
                <h1>Welcome</h1>
                <div class="mt-5">
                    <ul class="li-margin text-decoration-none flex justify-content-center">
                        <li><a href="{{ route('hr_dashboard') }}"><i class="fas fa-arrow-left"></i>Dashboard</a></li>
                        <li><a href="#">Profile<i class="fas fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
