@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidemenu.sidemenu')
@section('container')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link" aria-current="tab1" href="#tab_tab1" role="tab" data-toggle="tab">Personal Detail</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " aria-current="tab2" href="#tab_tab2" role="tab" data-toggle="tab">Office Timing</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="tab3" href="#tab_tab3" role="tab" data-toggle="tab">Department Detail</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " aria-current="tab4" href="#tab_tab4" role="tab" data-toggle="tab">Bank Detail</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " aria-current="tab5" href="#tab_tab5" role="tab" data-toggle="tab">PF Detail</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade" role="tabpanel" id="tab_tab1">
            {!! form($data['formUserDetail']) !!}
        </div>
        <div class="tab-pane fade" role="tabpanel" id="tab_tab2">
{{--            {!! form($data['formOfficeTiming']) !!}--}}
        </div>
        <div class="tab-pane fade show active" role="tabpanel" id="tab_tab3">
            {!! form($data['formDepartmentDetail']) !!}
        </div>
        <div class="tab-pane fade" role="tabpanel" id="tab_tab4">
            {!! form($data['formBankDetail']) !!}
        </div>
        <div class="tab-pane fade" role="tabpanel" id="tab_tab5">
            {!! form($data['formPFDetail']) !!}
        </div>
    </div>

@endsection

