<div>
    <div class="card bg-body mb-9 mb-xl-0 me-xl-9">


        <div class="card-body pb-6">


            <!--begin::blog-->
            <div class="mb-17">
                <!--begin::Title-->


            @include('livewire.forms.banner-central.noticia.components.upload-photo')

            <!--end::Wrapper-->
                <!--begin::Text-->
                <form>

                    <div class="row" id="inicioContext">
                        <div class="col-12 col-sm-3">
                            <div class="form-group mb-3">
                                <label
                                    class="required badge badge-sm badge-light pb-0">{{ $bannerCentralNoticias['title'] }}</label>
                                <input type="text" class="form-control form-control-sm" wire:model.defer="data.h1"
                                       placeholder="Introduza aqui a zona"/>
                                <span
                                    class="form-text text-muted">O preenchimento da zona é importante.</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group mb-4">
                                <label class=" badge badge-sm badge-light pb-0">Url link</label>
                                <input type="text" class="form-control form-control-sm" wire:model.defer="data.href"
                                       placeholder="Introduza aqui a zona"/>
                                <span class="form-text text-muted">Não é um requisito obrigatorio indicar a link</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group mb-4">
                                <label class="required badge badge-sm badge-light pb-0">Data</label>
                                <div class="input-group">
                                    <span class="input-group-text pl-3 pt-3">
                                        <i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control form-control-solid form-control-sm"
                                           wire:model.defer="data.dataAcontecimento" id="dataAcontecimento"
                                           placeholder="Data do Acontecimento"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group mb-3 mt-2">
                                <label class="required badge badge-light-primary">Conteudo de Destaque.</label>
                                <textarea class="form-control"
                                          wire:model.defer="data.p"
                                          rows="3"></textarea>
                                <span class="form-text text-muted">Não é um requisito obrigatorio indicar a link</span>
                            </div>
                        </div>
                        <div>
                            <div id="google_translate_element"></div>
                            @include('livewire.forms.banner-central.noticia.components.laraberg-area-texto')
                        </div>

                        <div class="col-12 col-sm-12 ">
                            <div class="form-group mb-3 mt-2 row">
                                <div class="col-sm-12">
                                    <label class="required badge badge-light-primary w-125px">Conteudo Curto.</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control form-control-sm"
                                           wire:model.defer="data.anexo1" accept="application/pdf"
                                           placeholder="Introduza aqui a zona"/>
                                </div>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control form-control-sm"
                                           wire:model.defer="data.anexo2" accept="application/pdf"
                                           placeholder="Introduza aqui a zona"/>
                                </div>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control form-control-sm"
                                           wire:model.defer="data.anexo3" accept="application/pdf"
                                           placeholder="Introduza aqui a zona"/>
                                </div>
                                <span class="form-text text-muted">Não é um requisito obrigatorio indicar a link</span>
                            </div>
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
                </form>
                <!--end::Text-->
                @livewire('forms.banner-central.noticia.lista-noticia')
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


        window.addEventListener('upload-image-click', event => {
            $('#upload').click();
        })


        imageBackground();

        function imageBackground(image = '') {
            $('#imagens').css("background-image", "url('/assets/banner-1.jpg')");
            if (image != '') {
                $('#imagens').css("background-image", "url(" + image + ")");
            }
        }

        window.addEventListener('activeFunctionality', evt => {
            imageBackground(evt.detail.temp_image);
        });

        window.addEventListener('success-send', evt => {
            toastr.success(evt.detail.message);
        })

        $(document).ready(function () {

            $('#upload').ijaboCropTool({
                preview: '.image-previewer',
                setRatio: 4,
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

        $('#dataAcontecimento').flatpickr({
            weekNumbers: true,
            enableTime: true,
            closeOnSelect: true,
            dateFormat: "Y-m-d H:i",

        });
        // Process translation


        $('#translate').on('click', evt => {


            var userLang = navigator.language || navigator.userLanguage;

            console.log(userLang);


        })

        /*function loadGoogleTranslate() {
            new google.translate.TranslateElement("google_element");
        }*/


        /* function loadGoogleTranslate() {
             setCookie('googtrans', '/en/pt', 1);
             new google.translate.TranslateElement({
                 pageLanguage: 'EN',
                 layout: google.translate.TranslateElement.InlineLayout.SIMPLE
             }, 'google_translate_element');
         }

         function setCookie(key, value, expiry) {
             var expires = new Date();
             expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
             document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
         }*/

        function googleSectionalElementInit() {
            setCookie('googtrans', '/en/lo', 1);
            new google.translate.SectionalElement({
                background: 'trasparent'
            }, 'google_sectional_element');
        }


        function setCookie(key, value, expiry) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }

        window.addEventListener('errorEvernt', evt => {
            toastr.info(evt.detail.message);
        })
        window.addEventListener('show-fails', evt => {
            toastr.error(evt.detail.message);
        })


        window.addEventListener('windoLocationNoticie', evt => {
            window.location.href = "#inicioContext"

        })
    </script>
@endpush
