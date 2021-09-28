@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu.sidemenu')

@section('container')
    <ul class="nav nav-pills" role="tablist">
        <li class="nav-item active">
            <a href="#tab_tab1" class="nav-link" aria-controls="tab1" role="tab" data-toggle="tab">Tab1</a>
        </li>
        <li class="nav-item">
            <a href="#tab_tab2" class="nav-link" aria-controls="tab2" role="tab" data-toggle="tab">Tab2</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade" role="tabpanel" id="tab_tab1">
            @livewire('leave-list-my-view')
        </div>
        <div class="tab-pane fade" role="tabpanel" id="tab_tab2">
            @livewire('leave-list-employees-view')
        </div>
    </div>

@endsection
