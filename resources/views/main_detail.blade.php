@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu.sidemenu')
@section('container')
{{--    <h1>Hellow</h1>--}}
        <livewire:attendance-detail-view :model="$model" />
@endsection

