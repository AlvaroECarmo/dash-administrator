<div>
    <div class="card bg-body mb-9 mb-xl-0 me-xl-9">

        <div class="card-body pb-6">

            <!--begin::blog-->
            <div class="mb-17">
                <!--begin::Title-->

                <div class="col-12 col-sm-5">
                    <div class="form-group mb-3">
                        <label class="required">Selecione o tipo de item</label>
                        <select class="form-select form-select-sm "
                                id="selectTipoViews"
                                wire:model="tipoViews"
                                data-allow-clear="true" data-control="select2"
                                data-placeholder="Seleciona o tipo de item">
                            <option></option>

                            <option value="1">Item de formatação Video Iterno</option>
                            <option value="2">Item de formatação Video Youtube</option>
                            <option value="3" selected>Item de formatação Imagem Interna</option>
                            <option value="4">Item de formatação Imagem Externa</option>
                            <option value="5">Item de formatação audio interno</option>

                        </select>

                    </div>
                </div>

                <div>

                    @if($tipoViews == 3)
                        <div class="overlay mb-11 @error('imgCapa') bg-danger @enderror">
                            <!--begin::Image-->

                            <div id="imagens" wire:ignore
                                 class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px overlay-wrapper"
                                 style="background-position: center; background-size: 100% "></div>

                            <!--end::Image-->
                            <!--begin::Links-->
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 ">
                                @if(!$photo)
                                    <a href="#" id="uploadImage" class="btn btn-sm btn-light-primary"
                                       wire:click.prevent="uploadImage"
                                    >Carregar</a>
                                    &nbsp;&nbsp;
                                    <a class="btn btn-sm btn-light-warning shadow d-block overlay"
                                       href="{{ asset('assets/media/page-title.jpg') }}"
                                       data-fslightbox="lightbox-hot-sales">
                                        Exibir
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-light-danger"
                                            wire:click.prevent="removeImage">Remover
                                    </button>
                                    &nbsp;&nbsp;
                                    <a class="btn btn-sm btn-light-warning shadow d-block overlay"
                                       href="{{ $photo->temporaryUrl() }}"
                                       data-fslightbox="lightbox-hot-sales">
                                        Exibir
                                    </a>
                                @endif

                            </div>

                            <input type="file" id="upload" class="d-none" accept=".png, .jpeg, .jpg"
                                   wire:model.defer="photo"/>

                            <!--end::Links-->
                            <!--info::mensagem de erro em caso que não foi selecionado a imagem-->
                            @error('imgCapa')
                            <span class="form-text text-white">{{ $message }}</span>
                            @enderror
                            <span style="float: right; margin-top: 10px"
                                  class="spinner-border  align-middle ms-2 float-right"
                                  wire:loading></span>
                        </div>
                    @elseif($tipoViews == 1)
                        <div class="overlay mb-11 ">
                            <!--begin::Image-->

                            <video style="width: 100%; height: 350px; border-radius: 10px " id="videoHas" controls>
                                <source src="">
                            </video>

                            <input type="file" id="uploadVideo" class="form-control form-control-sm" accept="video/*"
                                   wire:model="video"/>

                            <!--end::Links-->
                            <!--info::mensagem de erro em caso que não foi selecionado a imagem-->


                            @if($videoActual)
                                <span class="form-text text-success">Preview: {{ $videoActual }}</span>
                            @endif

                            @error('imgCapa')
                            <span class="form-text text-white">{{ $message }}</span>
                            @enderror
                            <span style="float: right; margin-top: 10px"
                                  class="spinner-border  align-middle ms-2 float-right"
                                  wire:loading></span>

                            <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                <div id="progress-bar" class="bg-success rounded h-8px" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @elseif($tipoViews == 2)
                        <div class="overlay mb-11 ">
                            <!--begin::Image-->
                            <iframe width="100%" height="350" style="border-radius: 10px"
                                    @if($videoImportId)
                                        src="{{ 'https://www.youtube.com/embed/' . $videoImportId }}"
                                    @else
                                        src="https://www.youtube.com/embed/yEftEVdMFJw"
                                    @endif
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>


                            <select class="form-select form-select-sm @error('primaryEmail') is-invalid @enderror"
                                    id="videoImport" wire:model="videoImportId">
                                @if( $videoImportName != '' )
                                    <option value="{{ $videoImportId }}">
                                        {{ $videoImportName }}
                                    </option>
                                @endif
                            </select>

                            {{--<input type="text" class="form-control form-control-sm" id="" wire:model="videoImport"/>--}}
                            <!--end::Links-->
                            <!--info::mensagem de erro em caso que não foi selecionado a imagem-->
                            @error('imgCapa')
                            <span class="form-text text-white">{{ $message }}</span>
                            @enderror
                            <span style="float: right; margin-top: 10px"
                                  class="spinner-border  align-middle ms-2 float-right"
                                  wire:loading></span>
                        </div>

                    @elseif($tipoViews == 4)
                        <div class="overlay mb-3">
                            <!--begin::Image-->

                            <div
                                class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px overlay-wrapper"
                                style="background-image: url({{ $urlImage??'assets/media/page-title.jpg' }}) ;background-position: center; background-size: 100% "></div>

                            <!--end::Image-->
                            <!--begin::Links-->
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 ">
                                @if(!$urlImage)
                                    {{--<a href="#" id="uploadImage" class="btn btn-sm btn-light-primary"
                                       wire:click.prevent="uploadExternalImageModal"
                                    >Carregar</a>--}}
                                    &nbsp;&nbsp;
                                    <a class="btn btn-sm btn-light-warning shadow d-block overlay"
                                       href="{{ asset('assets/media/page-title.jpg') }}"
                                       data-fslightbox="lightbox-hot-sales">
                                        Exibir
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-light-danger"
                                            wire:click.prevent="removeImageUrl">Remover
                                    </button>
                                    &nbsp;&nbsp;
                                    <a class="btn btn-sm btn-light-warning shadow d-block overlay"
                                       href="{{ $urlImage }}"
                                       data-fslightbox="lightbox-hot-sales">
                                        Exibir
                                    </a>
                                @endif

                            </div>
                            <!--end::Links-->
                            <!--info::mensagem de erro em caso que não foi selecionado a imagem-->
                        </div>
                        <input type="text" class="form-control form-control-sm" id="" wire:model="urlImage"/>
                        <span style="float: right; margin-top: 10px"
                              class="spinner-border  align-middle ms-2 float-right"
                              wire:loading></span>
                        <br>
                    @elseif($tipoViews == 5)
                        <form id="formAudio">

                            <div class="overlay mb-11 ">
                                <!--begin::Image-->

                                <audio style="width: 100%; height: 350px; border-radius: 10px " id="audioHas" controls>
                                    <source src="">
                                </audio>

                                @csrf

                                <input type="file" id="uploadVideo" name="audioFile"
                                       class="form-control form-control-sm"
                                       accept="audio/*" wire:model="audioRender">

                                <br>

                                @error('imgCapa')
                                <span class="form-text text-white">{{ $message }}</span>
                                @enderror

                                <span style="float: right; margin-top: 10px"
                                      class="spinner-border  align-middle ms-2 float-right"
                                      wire:loading></span>
                            </div>
                        </form>
                    @endif

                </div>

                <form>
                    <div class="row">
                        <div class="col-12 col-sm-3">
                            <div class="form-group mb-3">
                                <label class="required">Titulo</label>
                                <input type="text"
                                       class="form-control form-control-sm @error('title') is-invalid @enderror"
                                       wire:model="dataContext.title"
                                       placeholder="Introduza aqui a zona"/>

                                @error('title')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="form-group mb-4">
                                <label class="required badge-light-warning "
                                       style="padding-left: 5px ; padding-right: 5px">Conteudo introdutivo</label>
                                <input type="text" class="form-control form-control-sm"
                                       wire:model="dataContext.context"
                                       placeholder="Introduza aqui a zona"/>

                            </div>
                        </div>
                        <div class="form-group  mt-2 mb-3" data-instance="{{ $iteration }}">
                            <div class="" wire:ignore wire:key="obriga{{$iteration}}">
                                <label class="badge-light-info" style="padding-left: 5px ; padding-right: 5px">Informação
                                    completa</label>
                                <textarea wire:ignore.self class="form-control docs_ckeditor_classic"
                                          name="kt_docs_ckeditor_classic "
                                          wire:model="dataContext.fullContext"
                                          rows="5"></textarea>
                            </div>
                            @error('titleContext')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="separator border-secondary my-4"></div>
                    <div class="row">


                        <div class="col-12 col-sm-12 ">
                            <div class="form-group mb-3 mt-2 row">
                                <div class="col-sm-12 my-10">
                                    <label class=" badge-light-info cursor-pointer"
                                           style="padding-left: 5px ; padding-right: 5px"
                                           wire:click.prevent="openOrCloseAuthForm">
                                        {!! $contextInfoAuthForm !!} &nbsp;
                                    </label>
                                    <label class="required  badge-light-primary {{ $openOrCloseAuthForm }}"
                                           style="padding-left: 5px ; padding-right: 5px">Informação
                                        do Autor</label>
                                    <div class="separator separator-dotted border-secondary "></div>
                                </div>
                                <div class="{{ $openOrCloseAuthForm }}">
                                    <div class="col-12 col-sm-5">
                                        <div class="form-group mb-3">
                                            <label class="required">Nome</label>
                                            <input type="text"
                                                   class="form-control form-control-sm @error('auth') is-invalid @enderror "
                                                   wire:model.defer="dataAuth.auth"
                                                   placeholder="Introduza o nome do autor"/>
                                            @error('auth')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12">
                                        <div class="form-group mb-3">
                                            <label class="required badge badge-light-info">Conteudo</label>
                                            <textarea wire:ignore.self
                                                      class="form-control form-control-sm @error('context') is-invalid  @enderror "
                                                      name="kt_docs_ckeditor_classic "
                                                      wire:model.defer="dataAuth.context"
                                                      rows="3"></textarea>
                                            @error('context')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 mt-2 row">

                        <div class="col-sm input-group text-right justify-content-end">
                            <button type="button" class="btn btn-light-primary btn-sm mr-2"
                                    wire:click.prevent="createdVideoInterno">
                                Guardar a informação
                            </button>
                        </div>
                    </div>
                </form>
                <!--end::Wrapper-->

            </div>
            <!--end::blog-->
        </div>


    </div>

</div>
@push('scripts')

    <script>

        var i = 0;
        initSelector()
        document.addEventListener("DOMContentLoaded", () => {


            Livewire.hook('component.initialized', (component) => {
                initSelector()
                initTextArea();


            })
            Livewire.hook('element.initialized', (el, component) => {
            })
            Livewire.hook('element.updating', (fromEl, toEl, component) => {

            })
            Livewire.hook('element.updated', (el, component) => {
                console.log('Uploading.. '  + component + (++i) );
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

                initSelector()



            })


        });

        function initSelector() {


            $('#uploadVideo').on('change', (e) => {
                // console.log(e.target.value)

                $.post('{{ route('audio.store') }}', $("#formAudio").serialize() + '&=audio' + e.target.value, (response) => {
                    console.log(response);
                });
            })


            $('#videoImport').select2({
                language: "pt",
                allowClear: true,
                placeholder: 'Pesquise aqui o video',
                minimumInputLength: 1,
                ajax: {
                    url: '{{ route("api.myYoute")}}',
                    dataType: 'json',
                },
            }).on('change', () => {
                const departamento = $('#videoImport').select2('val');
                const departamentoName = $('#videoImport').select2('data')[0].text;

                @this.
                set('videoImportName', departamentoName);

                @this.
                set('videoImportId', departamento);
            })

            $("#sendInformation").on('click', () => {

                console.log($("#formAudio").serialize())

                console.log($("#uploadVideo").val())

                /*$.post("{{ route('audio.store') }}", $("#formAudio").serialize(), (e) => {
                    console.log(e)
                })*/
            })


            $('#selectTipoViews').select2().on('change', () => {

                const ele = $('#selectTipoViews').select2("val");
                @this.
                set('tipoViews', ele);

            });

        }

        window.addEventListener('show-fails', evt => {
            toastr.error(evt.detail.message);
        })

        $('#selectIcon').on('change', function (e) {
            $('#viewIcon').removeClass().addClass($('#selectIcon').select2("val"))
        });


        window.addEventListener('upload-image-click', event => {
            $('#upload').click();
        })

        window.addEventListener('upload-event', event => {
            imageBackground();
        })
        imageBackground();

        function imageBackground(image = '') {
            $('#imagens').css("background-image", "url('assets/media/page-title.jpg')");
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

        window.addEventListener('rendVideo', evt => {
            $("#videoHas").attr({
                "src": evt.detail.video
            })
        })


        window.addEventListener('rendAudio', evt => {
            $("#audioHas").attr({
                "src": evt.detail.audio
            })
        })

        try {
            @include('Comuns.doc-config', ['className'=> 'docs_ckeditor_classic'])
            initTextArea();

            function initTextArea() {

                watchdog.setCreator((element, config) => {
                    return CKSource.Editor.create(element, config)
                        .then(editor => {
                            editor.model.document.on('change:data', () => {
                                @this.
                                set('dataContext.fullContext', editor.getData())
                            })
                            console.log(editor);
                            return editor;
                        })
                });
            }

        } catch (e) {
            console.log(e)
        }


    </script>
@endpush
