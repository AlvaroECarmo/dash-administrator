<div class="col-xl-6">
    <!--begin::Details-->
    <div class="ps-xl-6">
        <!--begin::Body-->
        <div class="mb-7">
            <div class="d-flex align-items-center justify-content-between">
                <!--begin::Label-->
                <span class="badge badge-light-info text-uppercase fw-bolder my-2">Informações do deputado</span>
                <!--end::Label-->

            </div>

            <!--begin::Title-->
            <a href="#"
               class="fw-bolder text-dark mb-3 fs-3qx lh-sm text-hover-primary">{{ __($data['NomeDeputado']?:'Entidade Parlamentar') }}</a>
            <!--end::Title-->
            <!--begin::Text-->
            <div class="fw-bold fs-5 mt-3 text-gray-600">
                {!! __($data['otherProfessionalQualifications']?:'Não foi encontrado resultado!') !!}
            </div>
            <!--end::Text-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="d-flex flex-stack flex-wrap">
            <!--begin::Item-->
            <div class="d-flex align-items-center pe-2">
                <!--begin::Text-->
                <div class="fs-5 fw-bolder">
                                    <span
                                        class="font-weight-light">{{ __($data['primaveraFunc']?$data['primaveraFunc']['Email']:'Email não encontrado!') }}</span>
                </div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Details-->
</div>
