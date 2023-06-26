<div>
    <div class="card bg-body mb-9 mb-xl-0 me-xl-9">

        <div class="card-body pb-6">

            <!--begin::blog-->
            <div class="mb-17">
                <!--begin::Title-->


            @include('livewire.forms.banner-central.slider.components.upload-photo')

            <!--end::Wrapper-->
                <!--begin::Text-->
                <form>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-3">
                                <label class=" required">{{ $bannerCentral['title'] }}</label>
                                <input type="text" class="form-control form-control-sm" wire:model.defer="data.h1"
                                       placeholder="Introduza aqui a zona"/>
                                <span
                                    class="form-text text-muted">O preenchimento da zona é importante.</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group mb-4 d-none">
                                <label class="">{{ $bannerCentral['href'] }}</label>
                                <input type="text" class="form-control form-control-sm" wire:model.defer="data.href"
                                       placeholder="Introduza aqui a zona"/>
                                <span class="form-text text-muted">Não é um requisito obrigatorio indicar a link</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group mb-3 mt-2">
                                <label class="required badge badge-light-primary">Conteudo Curto.</label>
                                <textarea class="form-control"
                                          wire:model.defer="data.p"
                                          rows="3"></textarea>
                                <span class="form-text text-muted">Não é um requisito obrigatorio indicar a link</span>
                            </div>
                        </div>
                        @include('livewire.forms.banner-central.slider.components.laraberg-area-texto')
                        <div class="col-12 mt-2">
                            <div class="input-group text-right justify-content-end">
                                <button type="button" class="btn btn-light-primary btn-sm mr-2"
                                        wire:click.prevent="saveInfo">
                                    Guardar a informação
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

        $('#selectIcon').on('change', function (e) {
            $('#viewIcon').removeClass().addClass($('#selectIcon').select2("val"))
        });


        window.addEventListener('updated_image', event => {
            $('#upload').click();
        })

        window.addEventListener('message-error', event => {
            toastr.error(event.detail.message);
        })

        window.addEventListener('publicSlider', event => {
            toastr.error(event.detail.message);
        })




        imageBackground();

        function imageBackground(image = '') {
            $('#imagens').css("background-image", "url('/assets/banner-1.jpg')");
            if (image != '') {
                $('#imagens').css("background-image", "url(" + image + ")");
            }
        }

        window.addEventListener('activeFunctionality', evt => {

            imageBackground(evt.detail.temp_imge);
        });


        $(document).ready(function () {

            $('#upload').ijaboCropTool({
                preview: '.image-previewer',
                setRatio: 3,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['COPIAR', 'CANCELAR'],
                buttonsColor: ['#30bf7d', '#ee5155', -15],
                processUrl: '{{ route("crop") }}',
                withCSRF: ['_token', '{{ csrf_token() }}'],
                onSuccess: function (message, element, status) {
                    imageBackground()
                    @this.set('imageEditada', message);
                },
                onError: function (message, element, status) {
                    alert('error information');
                }
            });

        });
    </script>
@endpush
