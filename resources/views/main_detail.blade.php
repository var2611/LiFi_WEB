@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu')
@section('container')
    <livewire:attendance-detail-view :model="$id" />
@endsection

