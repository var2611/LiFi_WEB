@section('att-menu')
    <a href="#submenu0" data-toggle="collapse" aria-expanded="{{ $att ?? false }}"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start {{ isset($att) ? '' : 'collapsed' }}">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-user fa-fw mr-3"></span>
            <span class="menu-collapsed">Attendance</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>
    <!-- Submenu content -->
    <div id='submenu0' class="collapse sidebar-submenu {{ isset($att) ? 'show' : '' }}">
        @if(Auth::user()->isHR() || Auth::user()->isAdmin())
            <a href="{{ route('list-emp-attendance') }}"
               class="list-group-item list-group-item-action bg-dark text-white">
                <span>Employee Attendance</span>
            </a>
        @endif
        <a href="{{ route('list-my-attendance') }}"
           class="list-group-item list-group-item-action bg-dark text-white">
            <span>My Attendance</span>
        </a>
    </div>
@endsection
