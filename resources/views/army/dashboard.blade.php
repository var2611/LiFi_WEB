@extends('layouts.main_hr')
@extends('includes.header')
{{--@extends('includes.footer')--}}
{{--@extends('includes.sidemenu')--}}
@section('container')

    <div class="ml-3 pt-2">
        <a><i class="fas fa-home"></i>Dashboard</a>
    </div>
    <!-- Chart's container -->
    <div id="chart" style="height: 300px;"></div>
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

    <div class="card-list flex-wrap">
        @if(Auth::user()->isHR() || Auth::user()->isAdmin())
            <a href="{{ route('list-emp-attendance') }}">
                @else
                    <a href="{{ route('list-vehicle') }}">
                        @endif
                        <div class="card-hr">
                            <i class="fas fa-users fa-2x"></i>
                            <h1>Vehicle</h1>
                        </div>
                    </a>
                    <a href="{{ route('list-employee') }}">
                        <div class="card-hr">
                            <i class="fas fa-user fa-2x"></i>
                            <h1>Employee</h1>
                        </div>
                    </a>
    </div>

@endsection

