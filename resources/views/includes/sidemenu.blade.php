@section('sidemenu')
{{--    <div class="sidebar-expanded">--}}
{{--        <a class="no-padding" href="{{route('hr_dashboard')}}"><i class="fas fa-home"></i>Dashboard</a>--}}
{{--        <a href="{{ route('UsersAtt') }}">Attendance</a>--}}
{{--        <a href="{{ route('UsersList') }}">Users</a>--}}
    <!-- Bootstrap row -->
{{--        <div class="row" id="body-row">--}}
            <!-- Sidebar -->
            <div id="sidebar-container" class="hide-mobile sidebar-expanded d-none d-md-block"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
                <!-- Bootstrap List Group -->
                <ul class="list-group">
                    <!-- Separator with title -->
{{--                    <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">--}}
{{--                        <small>MAIN MENU</small>--}}
{{--                    </li>--}}
                    <!-- /END Separator -->
                    <!-- Menu with submenu -->
                    <a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                        </div>
                    </a>
                    <a href="{{route('hr_dashboard')}}" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-dashboard fa-fw mr-3"></span>
                            <span class="menu-collapsed">Dashboard</span>
{{--                            <span class="submenu-icon ml-auto"></span>--}}
                        </div>
                    </a>
                    <a href="{{ route('UsersAtt') }}" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-database fa-fw mr-3"></span>
                            <span class="menu-collapsed">Attendance</span>
                            {{--                            <span class="submenu-icon ml-auto"></span>--}}
                        </div>
                    </a>
                    <a href="{{ route('UsersList') }}" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-user fa-fw mr-3"></span>
                            <span class="menu-collapsed">Users</span>
                            {{--                            <span class="submenu-icon ml-auto"></span>--}}
                        </div>
                    </a>
{{--                    <a href="{{ route('UsersList') }}" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">--}}
{{--                        <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                            <span class="fa fa-user fa-fw mr-3"></span>--}}
{{--                            <span class="menu-collapsed">Leave</span>--}}
{{--                            <span class="submenu-icon ml-auto"></span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <!-- Submenu content -->--}}
{{--                    <div id='submenu1' class="collapse sidebar-submenu">--}}
{{--                        <a href="{{ route('UsersAtt') }}" class="list-group-item list-group-item-action bg-dark text-white">--}}
{{--                            <span>Attendance</span>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('UsersList') }}" class="list-group-item list-group-item-action bg-dark text-white">--}}
{{--                            <span>Users</span>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">--}}
{{--                            <span class="menu-collapsed">Tables</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                    <a href="#submenu2" data-toggle="collapse" aria-expanded="{{ $leave ?? false }}" class="bg-dark list-group-item list-group-item-action flex-column align-items-start {{ isset($leave) ? '' : 'collapsed' }}">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-envelope fa-fw mr-3"></span>
                            <span class="menu-collapsed">Leave</span>
                            <span class="submenu-icon ml-auto"></span>
                        </div>
                    </a>
                    <!-- Submenu content -->
                    <div id='submenu2' class="collapse sidebar-submenu {{ isset($leave) ? 'show' : '' }}">
                        <a href="{{ route('leave-apply') }}" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed">Apply leave</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed">My leave list</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed">Employee Leave List</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed">Leave Type List</span>
                        </a>
                    </div>
{{--                    <a href="#" class="bg-dark list-group-item list-group-item-action">--}}
{{--                        <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                            <span class="fa fa-tasks fa-fw mr-3"></span>--}}
{{--                            <span class="menu-collapsed">Tasks</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <!-- Separator with title -->--}}
{{--                    <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">--}}
{{--                        <small>OPTIONS</small>--}}
{{--                    </li>--}}
{{--                    <!-- /END Separator -->--}}
{{--                    <a href="#" class="bg-dark list-group-item list-group-item-action">--}}
{{--                        <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                            <span class="fa fa-calendar fa-fw mr-3"></span>--}}
{{--                            <span class="menu-collapsed">Calendar</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="bg-dark list-group-item list-group-item-action">--}}
{{--                        <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                            <span class="fa fa-envelope-o fa-fw mr-3"></span>--}}
{{--                            <span class="menu-collapsed">Messages <span class="badge badge-pill badge-primary ml-2">5</span></span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <!-- Separator without title -->--}}
{{--                    <li class="list-group-item sidebar-separator menu-collapsed"></li>--}}
{{--                    <!-- /END Separator -->--}}
{{--                    <a href="#" class="bg-dark list-group-item list-group-item-action">--}}
{{--                        <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                            <span class="fa fa-question fa-fw mr-3"></span>--}}
{{--                            <span class="menu-collapsed">Help</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}

                </ul><!-- List Group END-->
            </div><!-- sidebar-container END -->
{{--        </div><!-- body-row END -->--}}
{{--    </div>--}}
@endsection
