<div>
    <form>
        <div class="card-body">


            <div class="row">
                <div class="col-12 col-sm-7">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" wire:model.defer="data.date_region"
                               placeholder="busca aqui o deputado"/>

                    </div>
                </div>
                <div class="row mb-10 mb-lg-18">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Media-->
                        <div class="h-100 d-flex flex-column justify-content-between pe-xl-6 mb-xl-0 mb-10">
                            <!--begin::Wrapper-->
                            <div class="overlay mt-2">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-325px"
                                     style="background-image:url('../../assets/media/stock/600x400/img-80.jpg')"></div>
                                <!--end::Image-->
                                <!--begin::Links-->
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <a href="../about.html" class="btn btn-primary">About Us</a>
                                    <a href="../careers/apply.html" class="btn btn-light-primary ms-3">Join Us</a>
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Media-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Details-->
                        <div class="ps-xl-6">
                            <!--begin::Body-->
                            <div class="mb-7">
                                <div class="d-flex align-items-center justify-content-between">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-info text-uppercase fw-bolder my-2">Blog</span>
                                    <!--end::Label-->
                                </div>
                                <!--begin::Title-->
                                <a href="#" class="fw-bolder text-dark mb-3 fs-3qx lh-sm text-hover-primary">Bootstrap
                                    Admin
                                    -
                                    <br/>How To Get Started
                                    <br/>Tutorial.</a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-bold fs-5 mt-3 text-gray-600">We’ve been focused on making the from v4 to
                                    v5
                                    a but we’ve
                                    <br/>also not been afraid to step away been focused on from v4 to
                                    <br/>v5 speaker approachable making focused
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
                                        <a href="../user-profile/overview.html"
                                           class="text-gray-700 text-hover-primary">miguel.junhor</a>
                                        <span class="text-gray-500">@parlamento.ao</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Col-->
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group mb-3">
                        <label>{{ $entidadeParlamentar['title']}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" wire:model.defer="data.date_region"
                               placeholder="Introduza aqui a zona"/>
                        <span
                            class="form-text text-muted">O preenchimento da zona é importante.</span>
                    </div>


                    <div class="form-group mb-3">
                        <label>{{ $entidadeParlamentar['iconSelector']}} <span
                                class="text-danger">*</span></label>
                        <div class="row" style="padding-left: 10px!important;">
                            <div class="col-1 btn btn-secondary text-center ">
                                <i class="" id="viewIcon"></i>
                            </div>
                            <div class="col-5 col-md-6 col-sm-4 col-xl-10 col-xxl-11 col-lg-11">
                                <select class="form-select" data-control="select2" id="selectIcon"
                                        data-placeholder="Select an option">
                                    <option></option>
                                    <option value="fab fa-google">fab fa-google</option>
                                    <option value="fab fa-google-plus">fab fa-google-plus</option>
                                    <option value="fas fa-phone">fas fa-phone</option>
                                </select>
                            </div>
                        </div>

                        <span class="form-text text-muted">É importante selecionar o icone</span>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group mb-3">
                        <label>{{ $entidadeParlamentar['statuSelector']}}<span
                                class="text-danger">*</span></label>
                        <select class="form-select" data-control="select2"
                                data-placeholder="Selecciona o estado">
                            <option></option>
                            <option value="1">Activos</option>
                            <option value="2">Pendentes</option>
                        </select>
                        <span class="form-text text-muted">é importante seleccionar o estado</span>
                    </div>
                    <div class="form-group mb-2">
                        <label>{{ $entidadeParlamentar['datetime']}} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control"
                               value="{{ date('d') .' de '. date('M Y') . ', as '. date('H:i.s')  }}"
                               placeholder="Data actual de inserção" disabled/>
                        <span class="form-text text-muted">É importante selecionar o icone</span>
                    </div>

                </div>

                <div class="form-group mb-3 mt-2">
                    <label>{{ $entidadeParlamentar['note']}} <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control" name="kt_docs_ckeditor_classic h-200" rows="7"
                              id="kt_docs_ckeditor_classic"></textarea>
                </div>

                <div class="col-12 mt-2">
                    <div class="input-group text-right justify-content-end">
                        <button type="button" class="btn btn-primary mr-2" wire:click.prevent="save_header">Guardar a
                            informação
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                $('.selectorBoot').selectpicker();
            })
            Livewire.hook('element.initialized', (el, component) => {
            })
            Livewire.hook('element.updating', (fromEl, toEl, component) => {
            })
            Livewire.hook('element.updated', (el, component) => {
            })
            Livewire.hook('element.removed', (el, component) => {
            })
            Livewire.hook('message.sent', (message, component) => {
            })
            Livewire.hook('message.failed', (message, component) => {
            })
            Livewire.hook('message.received', (message, component) => {
            })
            Livewire.hook('message.processed', (message, component) => {
                $('.selectorBoot').selectpicker();
            })
        });

        $('#selectIcon').on('change', function (e) {

            $('#viewIcon').removeClass().addClass($('#selectIcon').select2("val"))
        });
        KTUtil.onDOMContentLoaded((function () {
            ClassicEditor
                .create(document.querySelector('#kt_docs_ckeditor_classic'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        }));
    </script>
@endpush
