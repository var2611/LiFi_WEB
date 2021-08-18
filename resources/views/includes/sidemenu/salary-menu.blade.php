@section('salary-menu')
    <a href="#submenu2" data-toggle="collapse"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-graduation-cap fa-fw mr-3"></span>
            <span class="menu-collapsed">Salary</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>

    <div id='submenu2' class="collapse sidebar-submenu">
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Allowance Type</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Role listings</span>
        </a>
    </div>
@endsection
