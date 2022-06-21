@section('import-upload-menu')
    <a href="#submenu5" data-toggle="collapse" aria-expanded="{{ $import ?? false }}"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-graduation-cap fa-fw mr-3"></span>
            <span class="menu-collapsed">Import / Upload</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>

    <div id='submenu5' class="collapse sidebar-submenu {{ isset($import) ? 'show' : '' }}">
        <a href="{{ route('sheet-import-emp-attendance-upload') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Attendance Import</span>
        </a>
        <a href="{{ route('sheet-import-emp-contracts') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Salary Contract Import</span>
        </a>
        <a href="{{ route('sheet-import-lat-long-data') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Lat Long Data</span>
        </a>

    </div>
@endsection
