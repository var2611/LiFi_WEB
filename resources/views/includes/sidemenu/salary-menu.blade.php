@section('salary-menu')
    <a href="#submenu3" data-toggle="collapse"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-graduation-cap fa-fw mr-3"></span>
            <span class="menu-collapsed">Salary</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>

    <div id='submenu3' class="collapse sidebar-submenu">
        <a href="{{ route('list-salary-allowance-type') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Allowance Types</span>
        </a>
        <a href="{{ route('salary-allowance-type-edit') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Add New Allowance Type</span>
        </a>
        <a href="{{ route('list-overtime-type') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Overtime Types</span>
        </a>
        <a href="{{ route('overtime-type-edit') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Add New Overtime Type</span>
        </a>
    </div>
@endsection
