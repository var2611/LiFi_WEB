@section('leave-menu')
    <a href="#submenu3" data-toggle="collapse" aria-expanded="{{ $leave ?? false }}"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start {{ isset($leave) ? '' : 'collapsed' }}">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-envelope fa-fw mr-3"></span>
            <span class="menu-collapsed">Leave</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>
    <!-- Submenu content -->
    <div id='submenu3' class="collapse sidebar-submenu {{ isset($leave) ? 'show' : '' }}">
        <a href="{{ route('leave-apply') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Apply leave</span>
        </a>
        <a href="{{ route('leave-list-my') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">My leave list</span>
        </a>
        <a href="{{ route('leave-list-emp') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Employee Leave List</span>
        </a>
        <a href="{{ route('leave-list-type') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Leave Type List</span>
        </a>
    </div>
@endsection
