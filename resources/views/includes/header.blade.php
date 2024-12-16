<?php $user = Auth::user() ?? null; $companyData = null; ?>
<?php if ($user) $companyData = $user->getCompanyData() ?? null; ?>

@section('header')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            {{--            <a class="navbar-brand" href="{{ url('/') }}"><img src="public/images/logo.svg" alt="logo">
                  {{ config('app.name', 'Laravel') }}
                </a>--}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/logo.png"
{{--                <img src="{{ URL::asset($c  ompanyData ? $companyData->logo : "images/logo.png"  ) }}"--}}
                     class="w-25"
                     alt="logo"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                                                @if (Route::has('register'))
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                    </li>
                                                @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="hide-desktop nav-item list-group-item">
                            <a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li class="hide-desktop nav-item list-group-item">
                            <a href="{{ route('list-emp-attendance') }}">Attendance</a>
                        </li>
                        <li class="hide-desktop nav-item list-group-item">
                            <a href="{{ route('list-employee') }}">Users</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
@endsection
