@extends('layouts.app')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

        <div id="kt_header" style="" class="header align-items-stretch">

            @livewire('layouts.header-brand')

            @livewire('layouts.top-bar')

        </div>

        <div>
            <div class="content d-flex flex-column flex-column-fluid " id="kt_content">

                <div id="kt_content_container" class="container-fluid">

                    <div class="row g-5 g-xxl-10">

                        <div class="col-xl-12 col-xxl-12 mb-xl-12 mb-xxl-12">

                            <div class="card card-flush h-xl-100">

                                <div class="card-header pt-5">

                                    <div class="card-title d-flex flex-column">

                                        <div class="d-flex align-items-center">

                                            <span class="fs-2hx fw-bolder text-dark me-2 lh-1">
                                                Perfil do Utilizador
                                            </span>

                                            <span class="badge badge-success fs-6 lh-1 py-1 px-2 d-flex flex-center"
                                                  style="height: 22px">
                                                &nbsp; 2.2%
                                            </span>
                                        </div>

                                        <span
                                            class="text-gray-400 pt-1 fw-bold fs-6">informações obtido no primavera</span>
                                    </div>

                                </div>

                                @livewire('auth.profile-form')

                            </div>

                        </div>

                    </div>

                    <div class="row g-5 g-xxl-10">



                    </div>

                </div>

            </div>
        </div>

    @livewire('layouts.footer')
    <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
@endsection
