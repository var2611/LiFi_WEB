@section('emp-contract-menu')
    <a href="#submenu4" data-toggle="collapse" aria-expanded="{{ $contract ?? false }}"
       class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-graduation-cap fa-fw mr-3"></span>
            <span class="menu-collapsed">Contracts</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>

    <div id='submenu4' class="collapse sidebar-submenu {{ isset($contract) ? 'show' : '' }}">
        <a href="{{ route('list-contract-type') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Contracts</span>
        </a>
        <a href="{{ route('list-contract-amount-type') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Amount Types</span>
        </a>
        <a href="{{ route('list-emp-contract-status') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Statuses</span>
        </a>
    </div>
@endsection
