@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu')
@section('container')
    <div class="w-screen-text">
        <h1>Welcome</h1>
        <div class="mt-5">
            <ul class="li-margin flex justify-content-center">
                <li><a><i class="fas fa-arrow-left"></i>Dashboard</a></li>
                <li><a>Profile<i class="fas fa-arrow-right"></i></a></li>
            </ul>
        </div>
    </div>
@endsection
