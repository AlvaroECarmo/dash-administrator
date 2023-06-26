<div>
    <form>


        <div class="card-body">

            <div class="col-12 mt-2 mb-2">

                <div class="input-group text-right justify-content-end">
                    <button type="button" class="btn btn-sm btn-light-success mr-2"
                            wire:click.prevent="moverImgPublish">
                        Publica Alterações
                    </button>
                    <a href="{{ route('api.youtube') }}" type="button" class="btn btn-sm btn-light-info mr-2"
                       wire:click.prevent="actualizar">
                        Actualizar
                    </a>
                </div>
            </div>
            <div class="mb-13">
                <!--begin::Wrapper-->
                <select class="form-select form-select-sm mb-3 @error('primaryEmail') is-invalid @enderror"
                        id="videoImport" wire:model="videoImportId">
                    @if( $videoImportName != '' )
                        <option value="{{ $videoImportId }}">
                            {{ $videoImportName }}
                        </option>
                    @endif
                </select>
                <div class="overlay mb-11">

                    <iframe src="https://www.youtube.com/embed/{{ $ideoSelect['id']['videoId'] }}"
                            style="border-radius: 10px"
                            width="100%" height="600" frameborder="0" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>


                    </iframe>
                    <div class="input-group text-right justify-content-end">
                        <button type="button" class="btn btn-sm btn-light-success mr-2"
                                wire:click.prevent="publicarPesquisado">
                            Publicar
                        </button>

                    </div>
                    <h1>
                        <span class="fs-5 font-weight-light text-info">{{ $ideoSelect['snippet']['title'] }}</span>
                    </h1>
                    <p class="mb-8">{{ $ideoSelect['snippet']['description'] }}</p>
                </div>
            </div>

            <div>
                <h1>
                    <span class="fs-5 font-weight-light text-info">Publicados Recentes</span>
                </h1>
                @livewire('forms.banner-central.video.lista-video')
            </div>

            <div class="row">
                @foreach($videosYA as $v)

                    <div class="col-12 col-sm-4 mb-6">
                        <div class="card-xl-stretch me-md-6">

                            <span class="d-block overlay" data-fslightbox="lightbox-hot-sales">

                                <div
                                    class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image:url('{{ $v['snippet']['thumbnails']['high']['url'] }}')"></div>

                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <span class="btn btn-sm btn-light-info"
                                          wire:click.prevent="destacarEste({{ collect($v) }})">
                                        Destacar Este
                                    </span>
                                </div>
                                @if(\App\Models\Parlamento\VideoYoutube::isEstaque(collect($v)))
                                    <span
                                        style="height: 10px; width: 10px; border-radius: 50%; position: absolute; bottom: 10px; left:10px"
                                        class="bg-success">&nbsp;</span>
                                @endif

                            </span>

                            <div class="mt-5">

                                <a href="#proximo passo"
                                   class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">
                                    {{ \Illuminate\Support\Str::limit($v['snippet']['title'], $limit = 40, $end = ' ...')  }}
                                </a>

                                <div class="font-weight-light fs-5 text-gray-600 my-3 h-35px">
                                    {{ \Illuminate\Support\Str::limit($v['snippet']['description'], $limit = 100, $end = ' ...')  }}
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="fs-6 fw-bolder">

                                        <span
                                            class="text-gray-500">{{ Date::parse($v['snippet']['publishedAt'])->format('d, M-Y')  }}</span>
                                        |
                                        <span
                                            class="text-dark">{{ $v['snippet']['channelTitle']  }}</span>

                                    </div>


                                    @if(\App\Models\Parlamento\VideoYoutube::isPublishd($v['id']['videoId']))
                                        <span wire:click.prevent="removedVideo({{ collect($v) }})"
                                              class="badge badge-light-danger fw-bolder my-2 cursor-pointer">DESFAZER</span>
                                    @else
                                        <span wire:click.prevent="publicarVideo({{ collect($v) }})"
                                              class="badge badge-light-primary fw-bolder my-2 cursor-pointer">PUBLICAR</span>
                                    @endif

                                    <span wire:click.prevent="selectdNews({{  collect($v) }})"
                                          class="badge badge-light-warning fw-bolder my-2 cursor-pointer">VER O VIDEO</span>

                                </div>
                            </div>

                        </div>
                        {{--@dump($v['snippet']['thumbnails'])--}}
                    </div>
                @endforeach


            </div>
        </div>

    </form>
</div>
@push('scripts')
    <script>
        initSelect();
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initSelect()
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
                initSelect()
            })
        });

        function initSelect() {

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
                const context = $('#videoImport').select2('data')[0].context
                const details = $('#videoImport').select2('data')[0].details

                @this.set('videoImportName', departamentoName)
                @this.set('context', context)
                @this.set('details', details)

                @this.set('videoImportId', departamento)
            })


            $('#select-lange').select2()
                .on('change', function () {

                    // this.selectedOptions[0].text
                    let context = $('#select-lange').select2("data")[0].text;

                    let dataSelect = $('#select-lange').select2("val");
                    @this.
                    set('data.context', dataSelect);

                    @this.
                    set('data.designation', context)
                });

            $('#header_main').select2().on('change', function (e) {

                let dataSelect = $('#header_main').select2("val");
                @this.
                set('data.listLange', dataSelect);
            });


        }


        window.addEventListener('send-success-video', event => {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toastr-bottom-center",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "600",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.success(event.detail.message);
        })

        window.addEventListener('init-component', function () {
            initSelect();
        })
    </script>
@endpush
