@section('lat-long-internet-menu')
    <a href="#submenu7" data-toggle="collapse" aria-expanded="{{ $lat_long ?? false }}"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-graduation-cap fa-fw mr-3"></span>
            <span class="menu-collapsed">Lat Long Data</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>

    <div id='submenu7' class="collapse sidebar-submenu {{ isset($lat_long) ? 'show' : '' }}">
        <a href="{{ route('sheet-import-lat-long-data') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Import</span>
        </a>
        <a href="{{ route('lat-long-non-internet-data') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">View</span>
        </a>

    </div>
@endsection
