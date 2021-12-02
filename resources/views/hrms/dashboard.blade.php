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
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('sample_chart')",
            hooks: new ChartisanHooks()
                .colors(['#46b246', '#4299E1'])
                .responsive()
                .beginAtZero()
                .legend({ position: 'bottom' })
                .title('This is a Attendance chart of users!')
                // .datasets([{ type: 'line', fill: true }, 'bar']),
        });
    </script>

    <div class="card-list">
        @if(Auth::user()->isHR() || Auth::user()->isAdmin())
            <a href="{{ route('list-emp-attendance') }}">
                @else
                    <a href="{{ route('list-my-attendance') }}">
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
                    <a href="#">
                        <div class="card-hr">
                            <i class="fas fa-envelope fa-2x"></i>
                            <h1>Salary</h1>
                        </div>
                    </a>
                    <a href="{{ route('list-contract-type') }}">
                        <div class="card-hr">
                            <i class="fas fa-envelope fa-2x"></i>
                            <h1>Contracts</h1>
                        </div>
                    </a>
    </div>

@endsection

