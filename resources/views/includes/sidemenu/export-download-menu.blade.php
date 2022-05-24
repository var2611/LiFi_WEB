@section('export-download-menu')
    <a href="#submenu6" data-toggle="collapse" aria-expanded="{{ $export ?? false }}"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-graduation-cap fa-fw mr-3"></span>
            <span class="menu-collapsed">Export / Download</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>

    <div id='submenu6' class="collapse sidebar-submenu {{ isset($export) ? 'show' : '' }}">
        <a href="{{ route('sheet-export-salary-form') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Salary Sheet</span>
        </a>
        <a href="{{ route('pdf-export-salary-slip-form') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Salary Slip</span>
        </a>
        <a href="{{ route('pdf-export-attendance-form') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Attendance Data</span>
        </a>
    </div>
@endsection
