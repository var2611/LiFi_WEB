@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu.sidemenu')

@section('container')
    {{--    {!! form($form) !!}--}}

    {!! form_start($form) !!}
    <div class="row">
            {!! form_row($form->name) !!}
            {!! form_row($form->description) !!}
        <div class="w-100"></div>
            {!! form_row($form->tags) !!}
    </div>
{{--    {!! form_row($form->btn) !!}--}}

    {!! form_end($form) !!}
@endsection

