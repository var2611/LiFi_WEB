@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu')

@section('container')
    {!! $view->render() !!}

    {{--
    <livewire:user-employee-table-view />
     @livewire('user-employee-table-view')
     --}}

@endsection
