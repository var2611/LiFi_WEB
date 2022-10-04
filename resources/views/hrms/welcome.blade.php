@extends('layouts.main_hr')
@extends('includes.header')
@section('container_no_margin')

    <?php $user = Auth::user() ?? null; $companyData = null; ?>
    <?php if ($user) $companyData = $user->getCompanyData() ?? null; ?>
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
        <div style="top: 0;
    height: 100%;
    width: 100%;
    -webkit-box-pack: center;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    background-position: 50% 50%;
    background-size: cover;
    background-image: url({{ URL::asset($companyData ? "images/" . $companyData->background : "images/background_rr.jpg") }});
        position: absolute;"></div>
        <div class="position-relative text-center mt-50">
            <h1 class="font-size text-white">Welcome</h1>
            <div class="text-white mt-5">
                <ul class="li-margin text-decoration-none flex hr-flex-column justify-content-center">
                    <li class="font-size"><a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i>Dashboard</a></li>
                    <li class="font-size"><a href="#">Profile<i class="fas fa-arrow-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection
