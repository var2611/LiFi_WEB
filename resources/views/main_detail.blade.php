@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu.sidemenu')
@section('container')

        @livewire("$class", ['model'=>$model])
@endsection

