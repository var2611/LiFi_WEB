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
            <a href="{{route('hr_dashboard')}}"
               class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapsed">Dashboard</span>
                    {{--                            <span class="submenu-icon ml-auto"></span>--}}
                </div>
            </a>

            @yield('att-menu')

            @yield('emp-menu')

            @yield('leave-menu')

            @yield('salary-menu')

            @yield('emp-contract-menu')


            <a href="{{ route('report-export-download') }}" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tree fa-fw mr-3"></span>
                    <span class="menu-collapsed">Export / Download</span>
                    {{--                            <span class="submenu-icon ml-auto"></span>--}}
                </div>
            </a><a href="{{ route('list-holiday') }}" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tree fa-fw mr-3"></span>
                    <span class="menu-collapsed">Holiday</span>
                    {{--                            <span class="submenu-icon ml-auto"></span>--}}
                </div>
            </a>
            <a href="#" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-birthday-cake fa-fw mr-3"></span>
                    <span class="menu-collapsed">Celebrations</span>
                    {{--                            <span class="submenu-icon ml-auto"></span>--}}
                </div>
            </a>

            <a href="#" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-gavel fa-fw mr-3"></span>
                    <span class="menu-collapsed">Company Policy</span>
                    {{--                            <span class="submenu-icon ml-auto"></span>--}}
                </div>
            </a>

        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->
@endsection
