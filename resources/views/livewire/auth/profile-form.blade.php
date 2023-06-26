<div>
    <form>
        <div class="card-body">


            <div class="row">

                <!--begin::Col-->
                <div class="col-12 col-md-12 col-xl-4">
                    <div class="image-input image-input-circle" style="background-image: url({{ $myPoto }}) ">
                        <div class="image-input-wrapper w-300px h-300px"
                             style="background-image: url('{{ $myPoto }}') "></div>

                        <!--begin::Edit button-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                               data-kt-image-input-action="change"
                               title="Change avatar">
                            <i class="fa fa-upload"></i>

                            <!--begin::Inputs-->
                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" id="inputChange"
                                   wire:model="photo"/>

                            <input type="hidden" name="avatar_remove"/>
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit button-->

                        <!--begin::Cancel button-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                              data-kt-image-input-action="cancel"
                              title="Cancel avatar">
                                 <i class="fa fa-trash"></i>
                             </span>
                        <!--end::Cancel button-->

                        <!--begin::Remove button-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                              data-kt-image-input-action="remove"
                              title="Remove avatar">

                                <i class="fa fa-trash"></i>

                             </span>
                        <!--end::Remove button-->
                    </div>

                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-12 col-xl-8 border border-left-1 border-bottom-0 border-right-0 border-top-0">
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
                            <a href="#" class="fw-bolder text-dark mb-3 fs-3qx lh-sm text-hover-primary">
                                {{ auth()->user()->ldap->getDisplayName() }}
                                <br/>

                            </a>
                            <span class="font-weight-light badge badge-light-info text-uppercase fw-bolder">
                                    {{ auth()->user()->ldap->getDepartment() }}
                                </span>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="fw-bold fs-5 mt-3 text-gray-600 " id="contextEditor">
                                Seja bem vindo ao ambiente administrativo do site parlamentar
                                <br/>é importante que o utilizador insira a sua foto do perfil
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="d-flex flex-stack flex-wrap">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center pe-2">

                                <!--begin::Text-->
                                <div class="fs-5 font-weight-light">
                                        <span class="text-gray-700 text-hover-primary">
                                            {{ auth()->user()->ldap->getEmail() }}
                                        </span>

                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Footer-->
                        <div class="form-group mb-3 mt-2" wire:ignore>
                            <label class="badge badge-light-primary">Outras informações</label>
                            <div class="docs_ckeditor_classic">{!! $texte_info !!}</div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="input-group text-right justify-content-end">
                                <button type="button" class="btn btn-light-primary btn-sm mr-2"
                                        wire:click.prevent="saveInfo">
                                    Guardar a informação
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--end::Details-->
                </div>
                <!--end::Col-->


            </div>
        </div>

    </form>
</div>
@push('scripts')
    <script>

        @include('Comuns.doc-config', ['className'=> 'docs_ckeditor_classic'])

        document.addEventListener("DOMContentLoaded", () => {

            Livewire.hook('component.initialized', (component) => {

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

            })
        });


        window.addEventListener('upload-image-click', () => {
            $('#uploadMesa').click();
        })

        window.addEventListener('init-components', () => {
            window.imageBack.init('', '/assets/media/149071.png', '#imageUpload');
        })

        window.addEventListener('activeFunctionality', evt => {
            window.imageBack.init(evt.detail.temp_image, '/assets/media/149071.png', '#imageUpload');
        });


        window.addEventListener('event-success', evt => {
            toastr.success(evt.detail.message, 'Novo Registro');
        })

        watchdog.setCreator((element, config) => {
            return CKSource.Editor.create(element, config)
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.
                        set('texte_info', editor.getData())
                    })
                    console.log(editor);
                    return editor;
                })
        });


    </script>
@endpush
