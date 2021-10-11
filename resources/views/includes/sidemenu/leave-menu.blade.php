@section('leave-menu')
    <a href="#submenu2" data-toggle="collapse" aria-expanded="{{ $leave ?? false }}"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start {{ isset($leave) ? '' : 'collapsed' }}">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-envelope fa-fw mr-3"></span>
            <span class="menu-collapsed">Leave</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>
    <!-- Submenu content -->
    <div id='submenu2' class="collapse sidebar-submenu {{ isset($leave) ? 'show' : '' }}">
        <a href="{{ route('edit-leave-apply') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Apply leave</span>
        </a>
        <a href="{{ route('list-leave-my') }}"
           class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">My leave list</span>
        </a>
        @if(Auth::user()->isHR() || Auth::user()->isAdmin())
            <a href="{{ route('list-leave-emp') }}"
               class="list-group-item list-group-item-action bg-dark text-white">
                <span class="menu-collapsed">Employee Leave List</span>
            </a>
            <a href="{{ route('list-leave-type') }}"
               class="list-group-item list-group-item-action bg-dark text-white">
                <span class="menu-collapsed">Leave Type List</span>
            </a>
        @endif
    </div>

@endsection
