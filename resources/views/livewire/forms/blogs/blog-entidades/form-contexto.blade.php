<div>
    <div class="card bg-body mb-9 mb-xl-0 me-xl-9">
        <div class="card-body pb-6">
            <!--begin::blog-->
            <div class="mb-17">

                <div class="row  justify-content-end">
                    <div class="col-12 col-sm-4">
                        <div class="form-group mb-3">
                            <label class="required badge badge-sm badge-light-primary">Página</label>
                            <select class="form-select form-select-sm @error('localkeyMenu') is-invalid @enderror"
                                    id="selectMenus"
                                    wire:model="capaData.menuId"
                                    data-allow-clear="true" data-control="select2"
                                    data-placeholder="Seleciona a pagina">
                                <option></option>
                                @foreach($itemMenu as $e)
                                    @if($e->class != 'dropdown')
                                        @if($e->url != "/")
                                            <option value="{{ $e->id }}">{{ $e->context }}</option>
                                        @endif
                                    @endif

                                @endforeach

                            </select>
                            @error('localkeyMenu')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-5">
                        <div class="form-group mb-3">
                            <label class="required">Entidade </label>

                            <select class="form-select form-select-sm @error('primaryEmail') is-invalid @enderror"
                                    id="deputados" wire:model="pagecofig.Email">
                                @if( $pagecofig['Nome'] != '' )
                                    <option value="{{ $pagecofig['Email'] }}">
                                        {{ $pagecofig['Nome'] }}
                                    </option>
                                @endif


                            </select>
                            @error('primaryEmail')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row" id="topContent">

                    @include('livewire.forms.blogs.blog-deputado.components.upload-photo')

                    <div class="col-12 col-xl-6">
                        <!--begin::Details-->
                        <div class="ps-xl-6">
                            <!--begin::Body-->
                            <div class="mb-7">
                                <div class="d-flex align-items-center justify-content-between">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-info text-uppercase fw-bolder my-2">Informações da entidade</span>
                                    <!--end::Label-->
                                </div>

                                <!--begin::Title-->
                                <a href="#"
                                   class="fw-bolder text-dark mb-3 fs-3qx lh-sm text-hover-primary">
                                    @isset($data['fullName'])
                                        {{ __($data['fullName']) }}
                                    @else
                                        Entidade Parlamentar
                                    @endif
                                </a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-bold fs-5 mt-3 text-gray-600 h-200px scroll-y">
                                    @isset($data['otherProfessionalQualifications'])
                                        {!! __($data['otherProfessionalQualifications']) !!}
                                    @else
                                        Não foi encontrado resultado!
                                    @endif
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
                                        class="font-weight-light">
                                        @isset($data['primaryEmail'])
                                            {{ __($data['primaryEmail']) }}
                                        @else
                                            Email não encontrado!
                                        @endif
                                    </span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Details-->
                    </div>
                </div>
                <form>
                    <div class="row">
                        <div class="col-12 col-sm-3">
                            <div class="form-group mb-3">
                                <label class="required">Nome </label>
                                <input type="text"
                                       class="form-control form-control-sm @error('fullName') is-invalid @enderror"
                                       wire:model="data.fullName"
                                       placeholder="Introduza aqui a zona"/>

                                @error('fullName')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-sm-3">
                            <div class="form-group mb-4">
                                <label class="">Departamento</label>
                                <select
                                    class="form-select form-select-sm @error('departamentoName') is-invalid @enderror"
                                    id="departamento"
                                    wire:model="pagecofig.departmentID">
                                    @if( $pagecofig['departamentoName'] != '' )
                                        <option value="{{ $pagecofig['departmentID'] }}">
                                            {{ $pagecofig['departamentoName'] }}
                                        </option>
                                    @endif
                                </select>
                                @error('departamentoName')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group mb-4">
                                <label class="required">Cargo</label>
                                <select class="form-select form-select-sm
                                    @error('cargoName') is-invalid @enderror"
                                        id="cargos" wire:model="pagecofig.cargoID">
                                    <option></option>
                                    @foreach($cargos as $c)
                                        <option value="{{ $c->id }}">{{ $c->title }}</option>
                                    @endforeach

                                </select>
                                @error('cargoName')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                        </div>

                        @include('livewire.forms.blogs.blog-deputado.components.laraberg-area-texto')

                    </div>
                    <div class="row col-12 col-sm-12">
                        <div class="col-12 col-sm-4">
                            <div class="form-group mb-3">
                                <label class="required">Tipo</label>
                                <div class="input-group input-group-sm flex-nowrap">
                                <span class="input-group-text h-35px text-black">
                                   <i class="{{ $icon }}"></i>
                                </span>
                                    <div class="overflow-hidden flex-grow-1 mb-2">
                                        <select
                                            class="form-select form-select-sm selector rounded-start-0 @error('icon') is-invalid @enderror"
                                            data-elements2="select2"
                                            id="selectIconSub" wire:model.defer="socialite.icon"
                                            data-placeholder="Seleccione o icone">
                                            <option></option>
                                            <option value="fab fa-facebook">Facebook</option>
                                            <option value="fab fa-twitter">Twitter</option>
                                            <option value="fab fa-linkedin">Linkedin</option>
                                            <option value="fab fa-youtube">Youtube</option>
                                        </select>
                                    </div>


                                </div>
                                @error('icon')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group mb-3">
                                <label class="required ">Link</label>
                                <div class="input-group input-group-sm flex-nowrap">
                                    <input type="text"
                                           class="form-control form-control-sm  @error('url') is-invalid  @enderror "
                                           wire:model.defer="socialite.url"
                                           placeholder="inseri aqui o linke do deputado."/>
                                    <button class="input-group-text h-35px text-black"
                                            wire:click.prevent="addSocialite">
                                        Adicionar
                                    </button>
                                </div>
                                @error('url')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        @foreach($socialites as $sociale)
                            <span>
                            <i class="{{ $sociale['icon'] }} fa-4x text-primary float-left"></i>
                             <button class="badge badge-circle badge-danger"
                                     wire:click.prevent="eliminarSocialite('{{ $sociale['icon'] }}')"
                                     style="position: relative;margin-bottom: -10px; margin-left: -20px; border: none">
                                <i class="fa fa-trash text-white"></i>
                            </button>
                        </span>
                            &nbsp;
                            &nbsp;

                        @endforeach
                    </div>

                    <div class="col-12 mt-2 row p-0">

                        <div class="col-sm input-group text-right justify-content-end p-0 m-0">
                            <button type="button" class="btn btn-light-primary btn-sm" style="margin-right: -10px"
                                    wire:click.prevent="cabaBlogPageSave">
                                Guardar a informação
                            </button>
                        </div>
                    </div>
                </form>
                <!--end::Wrapper-->


                @livewire('forms.blogs.blog-entidades.lista-capas')
                <div class="separator border-secondary my-10"></div>


            </div>

        </div>
        <div class="row" hidden>
            <input type="text" wire:model="action.updatekey" class="form-control form-control-sm col-sm-2">
            <input type="text" wire:model="action.deputy" class="form-control form-control-sm col-sm-2">
        </div>
    </div>

</div>
@push('scripts')
    <script>


        imageBackground();
        initSelector()

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
                initSelector()

            })
        });

        function initSelector() {

            $("#departamento").select2({
                language: "pt",
                allowClear: true,
                placeholder: 'Pesquise aqui o departamento',
                minimumInputLength: 1,
                ajax: {
                    url: '{{ route("api.department")}}',
                    dataType: 'json',
                },

            }).on('change', () => {
                const departamento = $('#departamento').select2('val');
                const departamentoName = $('#departamento').select2('data')[0].text;

                @this.
                set('pagecofig.departamentoName', departamentoName);

                @this.
                set('pagecofig.departmentID', departamento);
            });

            $("#deputados").select2({
                language: "pt",
                placeholder: 'Pesquise aqui a Entidade',
                allowClear: true,
                minimumInputLength: 1,
                ajax: {
                    url: '{{ route("api.funcionario")}}',
                    dataType: 'json',
                },

            }).on('change', () => {
                const entidade = $('#deputados').select2('val');
                const entidadeText = $('#deputados').select2('data')[0].text;
                @this.
                set('pagecofig.Email', entidade);

                @this.
                set('pagecofig.Nome', entidadeText);
            });

            $('#selectMenus').select2().on('change', () => {

                const ele = $('#selectMenus').select2("val")

                @this.set('capaData.menuId', ele)

                @this.set('itemMenuId', ele)
            });

            $('#cargos').select2({
                language: "pt",
                placeholder: 'Selecione aqui o cargo',
                allowClear: true,
            }).on('change', () => {
                const ele = $('#cargos').select2("val")

                const eleText = $('#cargos').select2('data')[0].text

                @this.set('pagecofig.cargoID', ele)
                @this.set('pagecofig.cargoText', eleText)
            });


            $('#selectIconSub').select2().on('change', function () {
                let data = $('#selectIconSub').select2("val")
                    // $("#imagsItem").attr("src", data);

                    @this.set('socialite.icon', data)
                    @this.set('icon', data)
            });


            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
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


        function imageBackground(image = '') {

            $('#imagens').css("background-image", "url('configimage/gallery-20.jpg')");

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
                setRatio: 1,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['INSERIR', 'CANCELAR'],
                buttonsColor: ['#30bf7d', '#ee5155', -15],
                processUrl: '{{ route("crop") }}',
                withCSRF: ['_token', '{{ csrf_token() }}'],
                onSuccess: function (message, element, status) {
                    imageBackground()
                    @this.set('imageEditada', message);
                },
                onError: function (message, element, status) {
                    alert()
                }
            });


            $(".actionSendins").on('click', () => {
                alert();
            })

        });

        window.addEventListener('setEditngValue', evt => {
            window.location.href = evt.detail.image
        })

        window.addEventListener('topContentIFEdit', evt => {
            window.location.href = "#topContent"
        })

    </script>
@endpush
