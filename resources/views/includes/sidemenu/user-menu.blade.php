@section('emp-menu')
    <a href="#submenu1" data-toggle="collapse"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-graduation-cap fa-fw mr-3"></span>
            <span class="menu-collapsed">Employee</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>

    <div id='submenu1' class="collapse sidebar-submenu">
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">New Employee</span>
        </a>
        <a href="{{ route('UsersList') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Employee List</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Bank Details</span>
        </a>
    </div>
@endsection
