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

        <div>
            {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
            <div class="content d-flex flex-column flex-column-fluid " id="kt_content">

                <div id="kt_content_container" class="container-fluid">

                    <div class="row g-5 g-xxl-10">
                        <!--begin::Col-->
                        <div class="col-xl-12 col-xxl-12 mb-xl-12 mb-xxl-12">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">

                                            <span
                                                class="fs-2hx fw-bolder text-dark me-2 lh-1">Nova Notícias</span>

                                            <span class="badge badge-success fs-6 lh-1 py-1 px-2 d-flex flex-center"
                                                  style="height: 22px">
                                                &nbsp; 2.2%
                                            </span>
                                        </div>

                                        <span class="text-gray-400 pt-1 fw-bold fs-6">Insira aqui as novidades.</span>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->

                                <!--begin::forms-cabecalhos-->
                            @livewire('forms.banner-central.noticia.form-noticia')
                            <!--end::forms-cabecalhos-->

                            </div>
                            <!--end::Card widget 4-->
                        </div>

                    </div>

                    <div class="row g-5 g-xxl-10">
                        <!--begin::lista-cabecalhos-->

                        <!--end::lista-cabecalhos-->
                    </div>

                </div>

            </div>
        </div>

    @livewire('layouts.footer')
    <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
@endsection
