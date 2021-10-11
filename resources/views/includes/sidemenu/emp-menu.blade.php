@section('emp-menu')
    @if(Auth::user()->isHR() || Auth::user()->isAdmin())
        <a href="#submenu1" data-toggle="collapse" aria-expanded="{{ $employee ?? false }}"
           class="bg-dark list-group-item list-group-item-action flex-column align-items-start {{ isset($users) ? '' : 'collapsed' }}">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-user fa-fw mr-3"></span>
                <span class="menu-collapsed">Employees</span>
                <span class="submenu-icon ml-auto"></span>
            </div>
        </a>
        <!-- Submenu content -->
        <div id='submenu1' class="collapse sidebar-submenu {{ isset($employee) ? 'show' : '' }}">
            <a href="{{ route('emp-registration-att-edit') }}"
               class="list-group-item list-group-item-action bg-dark text-white">
                <span>Register Employee</span>
            </a>
            <a href="{{ route('list-employee') }}"
               class="list-group-item list-group-item-action bg-dark text-white">
                <span>Employee List</span>
            </a>
            <a href="{{ route('list-role') }}" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="menu-collapsed">Role Types</span>
            </a>
        </div>
    @endif
@endsection
