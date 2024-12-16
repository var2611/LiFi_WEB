@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu.sidemenu')

@section('container')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"></h5>
                    </div>
                    <div class="card-body">
                        <div class="pl-4 ">
                            @include('layouts.form')
                            @if($form->getModel() && $form->getModel()->id_photo)
                                @php
                                         $fileUrl = asset('/storage/navtech/id_photo/'.$form->getModel()->id_photo);
                                        $extension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                                @endphp

                                <div class="mt-3">
                                    <label>Current ID Card Photo:</label>
                                    @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                                         <img src="{{ $fileUrl}}" alt="ID Card Photo" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                    @endif
                                </div>
                            @endif
                            {{-- Uncomment these if needed --}}
                            {{-- {!! form_start($form) !!} --}}
                            {{-- {!! form_row($form->title) !!} --}}
                            {{-- {!! form_until($form, 'description') !!} --}}
                            {{-- {!! form_end($form) !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        const fileInput = document.getElementById('icardPhoto');--}}
{{--        const maxSize = fileInput.getAttribute('data-max-size') * 1024;--}}
{{--        const errorText = document.createElement('p');--}}
{{--        errorText.style.color = 'red';--}}
{{--        errorText.style.display = 'none';--}}
{{--        errorText.id = 'fileError';--}}
{{--        errorText.style.margin = '0'; // Remove any default margins--}}
{{--        errorText.style.position = 'absolute'; // Prevent layout disruption--}}
{{--        errorText.style.fontSize = '12px';--}}
{{--        errorText.textContent = 'Please select file size less then 2 Mb ';--}}
{{--        fileInput.parentNode.appendChild(errorText);--}}

{{--        fileInput.addEventListener('change', function () {--}}
{{--            const file = fileInput.files[0];--}}
{{--            if (file && file.size > maxSize) {--}}
{{--                errorText.style.display = 'block';--}}
{{--                fileInput.value = '';--}}
{{--            } else {--}}
{{--                errorText.style.display = 'none';--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

