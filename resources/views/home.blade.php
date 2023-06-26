@extends('layouts.app')

@section('content')
    <!--begin::Wrapper-->
    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" style="" class="header align-items-stretch">
            <!--begin::Brand-->
            @livewire('layouts.header-brand')
            <!--end::Brand-->
            <!--begin::Topbar-->
            @livewire('layouts.top-bar')
            <!--end::Topbar-->
        </div>
        <!--end::Header-->

        <!--begin::Content-->
        @livewire('dashboard.home')
        <!--end::Content-->

        <!--begin::Footer-->
        @livewire('layouts.footer')
        <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
@endsection
