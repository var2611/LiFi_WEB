@extends('layouts.main_hr')
@extends('includes.header')
{{--@extends('includes.footer')--}}
{{--@extends('includes.sidemenu')--}}
@section('container')
    <div class="ml-3 pt-2">
        <a><i class="fas fa-home"></i>Dashboard</a>
    </div>
    <div class="card-list">
        @if(Auth::user()->isHR() || Auth::user()->isAdmin())
            <a href="{{ route('attendance-list-emp') }}">
                @else
                    <a href="{{ route('attendance-list-my') }}">
                        @endif
                        <div class="card-hr">
                            <i class="fas fa-users fa-2x"></i>
                            <h1>Attendance</h1>
                        </div>
                    </a>
                    <a href="{{ route('list-employee') }}">
                        <div class="card-hr">
                            <i class="fas fa-user fa-2x"></i>
                            <h1>User</h1>
                        </div>
                    </a>
                    <a href="{{ route('list-leave-my') }}">
                        <div class="card-hr">
                            <i class="fas fa-envelope fa-2x"></i>
                            <h1>Leave</h1>
                        </div>
                    </a>
    </div>

@endsection

