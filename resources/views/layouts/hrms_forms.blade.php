@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu.sidemenu')

@section('container')
    @include('layouts.form')
    {{--    {!! form_start($form) !!}--}}
    {{--    {!! form_row($form->title) !!}--}}
    {{--    {!! form_until($form, 'description') !!}--}}
    {{--    {!! form_end($form) !!}--}}
@endsection

