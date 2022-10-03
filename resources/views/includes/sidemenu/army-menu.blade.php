@section('sidemenu')
    <!-- Bootstrap row -->
    {{--        <div class="row" id="body-row">--}}
    <!-- Sidebar -->
    <div id="sidebar-container" class="hide-mobile sidebar-expanded d-none d-md-block">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            {{--                    <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">--}}
            {{--                        <small>MAIN MENU</small>--}}
            {{--                    </li>--}}
            <!-- /END Separator -->
            <!-- Menu with submenu -->
            <a href="#" data-toggle="sidebar-colapse"
               class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                </div>
            </a>
            <a href="{{route('home')}}"
               class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapsed">Dashboard</span>
                    {{--                            <span class="submenu-icon ml-auto"></span>--}}
                </div>
            </a>
            <a href="#submenu1" data-toggle="collapse" aria-expanded="{{ $vehicle ?? false }}"
               class="bg-dark list-group-item list-group-item-action flex-column align-items-start {{ isset($users) ? '' : 'collapsed' }}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">Vehicles</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu {{ isset($vehicle) ? 'show' : '' }}">
                <a href="{{ route('edit-vehicle-registration-army') }}"
                   class="list-group-item list-group-item-action bg-dark text-white">
                    <span>New Vehicle</span>
                </a>
                <a href="{{ route('list-vehicle') }}"
                   class="list-group-item list-group-item-action bg-dark text-white">
                    <span>List Vehicle</span>
                </a>
            </div>

            <a href="#submenu2" data-toggle="collapse" aria-expanded="{{ $employee ?? false }}"
               class="bg-dark list-group-item list-group-item-action flex-column align-items-start {{ isset($users) ? '' : 'collapsed' }}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">Employee</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu {{ isset($employee) ? 'show' : '' }}">
                <a href="{{ route('edit-emp-registration-att') }}"
                   class="list-group-item list-group-item-action bg-dark text-white">
                    <span>New Employee</span>
                </a>
                <a href="{{ route('list-employee') }}"
                   class="list-group-item list-group-item-action bg-dark text-white">
                    <span>List Employee</span>
                </a>
            </div>
        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->
@endsection
