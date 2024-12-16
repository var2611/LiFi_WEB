<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LiFi - {{ $title ?? config('app.name', 'Laravel') }}</title>


    {{--    <script src="{{ asset('js/testing.js') }}" defer></script>--}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
<div id="app">

    <div class="navbar-top">
        <div class="navbar-top-left">
            <div class="brand-logo">
                <a href="{{ route('home') }}">
                        <img src="{{ asset('logo.png') }}"
                             alt="{{ config('app.name') }}"/>
                </a>
            </div>
        </div>

        <div class="navbar-top-right">
            <div class="profile">
            <span class="avatar">
            </span>

                <div class="profile-info">
                    <div class="dropdown-toggle">
                        <div style="display: inline-block; vertical-align: middle;">
                        <span class="name">
                            {{ Auth::user()->name }}
                        </span>

                            <span class="role">
                            {{ Auth::user()->UserEmployee->UserRole->name }}
                        </span>
                        </div>
                        <i class="icon arrow-down-icon active"></i>
                    </div>

                    <div class="dropdown-list bottom-right">
                        <span
                            class="app-version">{{ 'V 1.0.0' }}</span>

                        <div class="dropdown-container">
                            <label>Account</label>
                            <ul>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar-left">

        {{-- button for expanding nav bar --}}
        <nav-slide-button id="nav-expand-button" icon-class="accordian-right-icon"
                          style="display: none;"></nav-slide-button>

        {{-- left menu bar --}}
        <ul class="menubar">
            <li class="menu-item active">
                <a href="#">
                    <span class="icon dashboard-icon"></span>

                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

    </div>
</div>

<script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', function() {
        moveDown = 60;
        moveUp =  -60;
        count = 0;
        countKeyUp = 0;
        pageDown = 60;
        pageUp = -60;
        scroll = 0;

        listLastElement = $('.menubar li:last-child').offset();

        if (listLastElement) {
            lastElementOfNavBar = listLastElement.top;
        }

        navbarTop = $('.navbar-left').css("top");
        menuTopValue = $('.navbar-left').css('top');
        menubarTopValue = menuTopValue;

        documentHeight = $(document).height();
        menubarHeight = $('ul.menubar').height();
        navbarHeight = $('.navbar-left').height();
        windowHeight = $(window).height();
        contentHeight = $('.content').height();
        innerSectionHeight = $('.inner-section').height();
        gridHeight = $('.grid-container').height();
        pageContentHeight = $('.page-content').height();

        if (menubarHeight <= windowHeight) {
            differenceInHeight = windowHeight - menubarHeight;
        } else {
            differenceInHeight = menubarHeight - windowHeight;
        }

        if (menubarHeight > windowHeight) {
            document.addEventListener("keydown", function(event) {
                if ((event.keyCode == 38) && count <= 0) {
                    count = count + moveDown;

                    $('.navbar-left').css("top", count + "px");
                } else if ((event.keyCode == 40) && count >= -differenceInHeight) {
                    count = count + moveUp;

                    $('.navbar-left').css("top", count + "px");
                } else if ((event.keyCode == 33) && countKeyUp <= 0) {
                    countKeyUp = countKeyUp + pageDown;

                    $('.navbar-left').css("top", countKeyUp + "px");
                } else if ((event.keyCode == 34) && countKeyUp >= -differenceInHeight) {
                    countKeyUp = countKeyUp + pageUp;

                    $('.navbar-left').css("top", countKeyUp + "px");
                } else {
                    $('.navbar-left').css("position", "fixed");
                }
            });

            $("body").css({minHeight: $(".menubar").outerHeight() + 100 + "px"});

            window.addEventListener('scroll', function() {
                documentScrollWhenScrolled = $(document).scrollTop();

                if (documentScrollWhenScrolled <= differenceInHeight + 200) {
                    $('.navbar-left').css('top', -documentScrollWhenScrolled + 60 + 'px');
                    scrollTopValueWhenNavBarFixed = $(document).scrollTop();
                }
            });
        }
    });
</script>

</body>
</html>
