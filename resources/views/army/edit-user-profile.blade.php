@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidemenu.sidemenu')
@section('container')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" aria-current="tab1" href="#tab_tab1" role="tab" data-toggle="tab">Personal Detail</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" role="tabpanel" id="tab_tab1">
            {!! form($data['formUserDetail']) !!}
        </div>
    </div>

@endsection

