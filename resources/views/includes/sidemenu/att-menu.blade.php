@section('att-menu')
    <a href="{{ route('UsersAtt') }}"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-database fa-fw mr-3"></span>
            <span class="menu-collapsed">Attendance</span>
            {{--                            <span class="submenu-icon ml-auto"></span>--}}
        </div>
    </a>
@endsection
