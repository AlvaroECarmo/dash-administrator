<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}"
      rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('') }}assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">
@livewireStyles
<style>


    .ck .ck-editor__top .ck-reset_all {
        border-radius: 2px !important;
    }

    .block-editor-block-contextual-toolbar {
        top: -10px !important;
    }

    body::-webkit-scrollbar {
        width: 8px; /* width of the entire scrollbar */
    }

    body::-webkit-scrollbar-track {
        background: rgba(255, 165, 0, 0); /* color of the tracking area */
    }

    body::-webkit-scrollbar-thumb {
        background-color: #0b1e2c; /* color of the scroll thumb */
        border-radius: 20px; /* roundness of the scroll thumb */
        border: 3px solid rgba(255, 165, 0, 0); /* creates padding around scroll thumb */
    }
</style>

@yield('third_party_stylesheets')
@stack('page_css')

<link rel="stylesheet" href="{{asset('assets/plugins/cropimage/ijaboCropTool.min.css')}}">
<link rel="shortcut icon" href="{{ asset('assets/icons/favicon.ico') }}">
{{-- SHORTCUT ICON --}}
<link rel="manifest" href="/manifest.webmanifest">
<link rel="stylesheet" href="{{ asset('') }}assets/cropper/cropper.css">
<link rel="stylesheet" href="{{ asset('') }}assets/cropper/main.css">
