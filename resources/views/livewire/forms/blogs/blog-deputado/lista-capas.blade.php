<div>
    <div class="row g-10 row-cols-2 row-cols-lg-12 ">
        <div class="form-group mb-3 ">
            <label class="">pesquisar</label>
            <input type="text" class="form-control form-control-sm" wire:model="search"
                   placeholder="buscar a informação do deputado pelo nome">

        </div>


        <div class="form-group mb-3 " wire:ignore>
            <label class="">legislatura</label>
            <select class="form-select form-select-sm"
                    id="selectMenusEW"
                    wire:model="menuIdlegis"
                    data-allow-clear="true" data-control="select2"
                    data-placeholder="Seleciona a pagina">
                <option></option>
                @foreach($itemMenuDepu as $es)
                    @if($es->class != 'dropdown')
                        @if($es->url != "/")
                            <option value="{{ $es->url }}">{{ $es->context }}</option>
                        @endif
                    @endif
                @endforeach
            </select>

        </div>
    </div>
    <div class="my-10">

        <div class="row g-10 row-cols-2 row-cols-lg-6" wire:sortable="actualizandoTaskOrder">
            @foreach($capas as $capa)
                <div class="row w-750px mb-5">
                    <div class="col-sm-5">
                        <div class="h-100 d-flex flex-column justify-content-between pe-xl-6 mb-xl-0 mb-10"
                             wire:sortable.item="{{ $capa->id }}" wire:key="item-{{ $capa->id }}">
                            <!--begin::Wrapper-->
                            <div class="overlay mt-2">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-225px"
                                     style="background-image:url('{{ Storage::url($capa->imgCapa) }}'); background-position-y: -30px"></div>
                                <!--end::Links-->
                            </div>
                            <!--end::Wrapper-->
                            <div class="overlay-layer mt-2">
                                <a class="overlay" data-fslightbox="lightbox-hot-sales"
                                   href="{{ Storage::url($capa->imgCapa) }}">
                                        <span class="badge badge-light-warning">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                </a>
                                <span class="badge badge-light-primary cursor-pointer"
                                      wire:click.prevent="edtitElement({{ $capa }})">
                                    <i class="fa fa-edit "></i>
                                </span>
                                <span class="badge badge-light-danger cursor-pointer"
                                      wire:click.prevent="removeElement({{ $capa }})">
                                    <i class="fa fa-trash "></i>
                                </span>

                                <span class="badge badge-light-primary" wire:sortable.handle>
                                    <i class="fa fa-truck-moving "></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="ps-xl-6">
                            <!--begin::Body-->
                            <div class="mb-7">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="my-2">
                                        @isset($capa->legislature->context)
                                            <span class="text-primary">
                                                {{ $capa->legislature->context }}
                                            </span>
                                        @else
                                            <span class="text-warning">Menu registro</span>
                                        @endif
                                    </span>
                                </div>

                                <a href="#"
                                   class=" badge-light-info  fw-bolder my-2">
                                    @isset($capa->depudy['fullName'])
                                        {{ __($capa->depudy['fullName']) }}
                                    @else
                                        Entidade Parlamentar
                                    @endif
                                </a>
                                <div rows="3"
                                     style="border: none; height: 150px; max-height:150px!important;  overflow-y: auto; "
                                     class="form-control w-450px">@isset($capa['context']){!! __($capa['context']) !!}@endif</div>
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
                                        @isset($capa->email)
                                            {{ __($capa->email) }}
                                        @else
                                            Email não encontrado!
                                        @endif
                                    </span>

                                        <div class="overlay-layer mt-2">
                                            @foreach($capa->socials as $itenn)
                                                <a
                                                    href="{{ $itenn->href }}" target="_blank">
                                                <span class="badge badge-light-warning">
                                                    <i class="{{ $itenn->icon }}"></i>
                                                </span>
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Footer-->
                        </div>
                    </div>
                    {{-- border-secondary --}}
                    <div class="separator border-2  my-10"></div>
                </div>

            @endforeach


        </div>
        <div style="float: right">

            {{ $capas->links() }}

        </div>
        <div class="col-12 mt-2">
            <div class="input-group">
                <button type="button" class="btn btn-sm btn-light-success" wire:click.prevent="publicTCapa">
                    Publica Alterações
                </button>
            </div>
        </div>
        <!--begin::Row-->

    </div>
</div>
@push('scripts')
    <script>
        initRadio();
        initSelector()
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initRadio();
                initSelector()
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

        function initRadio() {
            $(".radioInfor").attr("checked", false);
        }

        function initSelector() {


            $('#selectMenusEW').select2().on('change', () => {
                const ele = $('#selectMenusEW').select2("val");
                @this.
                set('menuIdlegis', ele);
            });


            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        }


    </script>
@endpush
