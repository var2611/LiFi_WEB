@extends('layouts.main_hr')
@extends('includes.header')
{{--@extends('includes.sidemenu')--}}
@section('container')
    <div class="ml-3 pt-2">
        <a><i class="fas fa-home"></i>Dashboard</a>
    </div>
    <div class="card-list">
        <div class="card-hr">
            <i class="fas fa-users fa-2x"></i>
            <h1>Attendance</h1>
        </div>
        <a href="{{ route('UsersList') }}">
            <div class="card-hr">
                <i class="fas fa-user fa-2x"></i>
                <h1>User</h1>
            </div>
        </a>

    </div>

@endsection
