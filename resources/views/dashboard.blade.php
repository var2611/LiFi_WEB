@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu')
@section('container')
    @livewire('users-table-view')

    {{--
    <livewire:user-employee-table-view />
     @livewire('user-employee-table-view')
     {!! $view->render() !!}
     --}}

@endsection