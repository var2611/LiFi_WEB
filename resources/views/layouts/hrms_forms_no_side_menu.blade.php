@extends('layouts.main_hr')
@extends('includes.header')

@section('container')
    <div>
    @include('layouts.form')
    {{--    {!! form_start($form) !!}--}}
    {{--    {!! form_row($form->title) !!}--}}
    {{--    {!! form_until($form, 'description') !!}--}}
    {{--    {!! form_end($form) !!}--}}
    </div>
@endsection

