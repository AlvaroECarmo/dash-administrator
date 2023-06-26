<div>
    <div class="card bg-body mb-9 mb-xl-0 me-xl-9">
        <div class="card-body pb-6">
            <!--begin::blog-->
            <div class="mb-17">

                <!--begin::Text-->
                <form>
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-6">
                            <div class="overlay mt-2">
                                <!--begin::Image-->
                                <div wire:ignore id="imagensDifi"
                                     class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-325px"></div>
                                <!--end::Image-->
                                <!--begin::Links-->

                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25 ">
                                    @if(!$photo)
                                        <a href="#" wire:click.prevent="uploadImage"
                                           class="btn btn-light-primary btn-sm">Carregar</a>
                                        <a href="/assets/about-1.jpg"
                                           class="btn btn-light-warning ms-3 btn-sm overlay"
                                           data-fslightbox="lightbox-hot-sales">Exibir</a>
                                    @else

                                        <button wire:click.prevent="removeImage"
                                                class="btn btn-light-danger btn-sm">Remover
                                        </button>
                                         <a href="{{ $photo->temporaryUrl() }}"
                                            class="btn btn-light-warning ms-3 btn-sm overlay"
                                            data-fslightbox="lightbox-hot-sales">Exibir</a>
                                    @endif
                                </div>
                                <!--end::Links-->
                            </div>
                            <input type="file" id="imageForme" class="d-none" accept=".png, .jpeg, .jpg"
                                   wire:model.defer="photo">
                        </div>

                        <div class="col-12 col-sm-12 mt-10 row">
                            <div class="col-12 col-sm-3">
                                <div class="form-group mb-3">
                                    <label>{{ $bannerCentral['title'] }}<span class="text-danger mb-2">*</span></label>
                                    <input type="text" class="form-control form-control-sm mt-3"
                                           wire:model.defer="data.title"
                                           placeholder="Introduza aqui a zona"/>
                                    <span class="form-text text-muted">
                                    O preenchimento da zona é importante.
                                </span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group mb-3">
                                    <label>{{ $bannerCentral['title2'] }}<span class="text-danger mb-2">*</span></label>
                                    <input type="text" class="form-control form-control-sm mt-3"
                                           wire:model.defer="data.subTitle"
                                           placeholder="Introduza aqui a zona"/>
                                    <span class="form-text text-muted">
                                    O preenchimento da zona é importante.
                                </span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group mb-3">
                                    <label
                                        class="required badge badge-light-info">{{ $bannerCentral['context'] }}</label>
                                    <textarea type="text" class="form-control form-control-sm" rows="3"
                                              style="height: 88px" wire:model.defer="data.h5" maxlength="320"
                                              placeholder="Introduza aqui a zona"></textarea>
                                    <span class="form-text text-muted">
                                    O preenchimento da zona é importante.
                                </span>
                                </div>
                            </div>

                        </div>

                        @include('livewire.forms.banner-central.defin-composicao.components.laraberg-area-texto')
                        <div class="col-12 mt-2">
                            <div class="input-group text-right justify-content-end">
                                <button type="button" class="btn btn-light-primary btn-sm mr-2"
                                        wire:click.prevent="saveInfo">
                                    Guardar a
                                    informação
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Text-->
            </div>
            <!--end::blog-->
        </div>


    </div>
</div>
@push('scripts')
    <script>

        @include('comuns.doc-config', ['className'=>'kt_docs_ckeditor_classic222'])
        watchdog.setCreator((element, config) => {
            return CKSource.Editor.create(element, config)
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.
                        set('data.p', editor.getData())
                    })
                    console.log(editor);
                    return editor;
                })
        });
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

        $('#selectIcon').on('change', (e) => {
            $('#viewIcon').removeClass().addClass($('#selectIcon').select2("val"))
        });


        window.addEventListener('init', event => {
            iniconfig()
        })
        window.addEventListener('success-event', evt => {
            toastr.success(evt.detail.message)
        })


        window.addEventListener('updated_image', evt => {
            $('#imageForme').click();
        })
        imageBackground();


        function imageBackground(image = '') {
            $('#imagensDifi').css("background-image", "url('/assets/about-1.jpg')");
            if (image != '') {

                $('#imagensDifi').css("background-image", "url(" + image + ")");
            }
        }

        window.addEventListener('set-image', evt => {
            imageBackground(evt.detail.imageEvent);
        })


    </script>
@endpush
