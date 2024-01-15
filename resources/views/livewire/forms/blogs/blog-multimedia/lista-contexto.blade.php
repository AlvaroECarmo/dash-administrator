<div>
    <div class="card-body p-0">
        <!--begin::Latest posts-->

        <div class="mb-15">
            <div class="col-12 col-sm-5 p-5">
                <div class="form-group mb-3">
                    <label class="required">Selecione o tipo de item</label>
                    <select class="form-select form-select-sm "
                            id="selectTipoViewsContext"
                            wire:model="tipoViews"
                            data-allow-clear="true" data-control="select2"
                            data-placeholder="Seleciona o tipo de item">
                        <option></option>

                        <option value="1">Item de formatação Video Iterno</option>
                        <option value="2">Item de formatação Video Youtube</option>
                        <option value="3" selected>Item de formatação Imagem Interna</option>
                        <option value="4">Item de formatação Imagem Esterna</option>
                        <option value="5">Item de formatação audio interno</option>
                        <option value="0">Todas as formartações</option>

                    </select>

                </div>
            </div>
            <!--begin::Posts-->
            <div class="row g-10" wire:sortable="updateTaskOrder">
                @foreach($blogPagBody as $item)
                    <div class="col-md-4" wire:sortable.item="{{ $item->id }}" wire:key="item-{{ $item->id }}">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch ms-md-6">
                            <!--begin::Overlay-->
                            <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                               @if($item->typeMultimedia ==  5  )
                               href="/assets/media/audioimage.webp"
                               @else
                               href="{{$item->urlSternal??$item->urlFile }}"
                                @endif >

                                <!--begin::Image-->
                                @if($item->typeMultimedia ==  5  )
                                    <div
                                        class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url(/assets/media/audioimage.webp)">

                                    </div>
                                @elseif($item->typeMultimedia ==  1  )
                                    <div
                                        class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url(/assets/media/videosimage.jpg)">

                                    </div>
                                @elseif($item->typeMultimedia ==  2)
                                    <div
                                        class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url({{ $item->urlSternal }})">
                                    </div>
                                @else
                                    <div
                                        class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        @if(!$item->urlFile)
                                        style="background-image:url({{ __('/assets/about-1.jpg') }})"
                                        @else
                                        style="background-image:url({{ __($item->urlFile) }})"
                                        @endif>

                                    </div>
                                @endif

                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="fa fa-eye fs-2x text-white"></i>
                                </div>

                                <!--end::Action-->
                            </a>
                            <!--end::Overlay-->
                            <!--begin::Body-->

                            <div class="mt-5">
                                <!--begin::Title-->
                                <a href="#"
                                   class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">
                                    <div style="width: 94%; overflow: hidden;
                                        text-overflow: ellipsis; white-space: nowrap;">
                                        {!!  $item->titleContext  !!}
                                    </div>
                                </a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-bold fs-5 text-gray-600 my-3"
                                     style="overflow: hidden; max-height: 100px; height: 72px; border:1px; text-overflow: ellipsis;">
                                    {!!   $item->introdutionContext!!}
                                </div>
                                <!--end::Text-->
                                <!--begin::Content-->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="fs-6 fw-bolder">
                                        <!--begin::Date-->
                                        <span class="text-gray-500">
                                            {{ Date::parse($item->created_at)->format('d, M Y') }}</span>
                                        <!--end::Date-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Label-->
                                    <span>
                                        @isset($item->banner)

                                            <span
                                                class="badge badge-light-info fw-bolder my-2 btn btn-sm btn-light-info"
                                                style="cursor: pointer;"><i class="fa fa-eye"></i> Autor</span>&nbsp;

                                        @endif

                                        <span class="badge badge-light-danger fw-bolder py-2"
                                              style="cursor: pointer" wire:click.prevent="removeItem({{ $item }})">
                                            <i class="fa fa-trash text-danger"></i> </span> &nbsp;

                                        <span class="badge badge-light-warning fw-bolder my-2 btn btn-sm btn-light-info"
                                              style="cursor: pointer" wire:sortable.handle><i
                                                class="fa fa-truck-moving"></i></span>

                                    </span>
                                    <!--end::Label-->
                                </div>
                            </div>


                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                @endforeach
                <div class="justify-content-end float-right">
                    {{ $blogPagBody->links() }}
                </div>
                <!--begin::Col-->
            </div>
            <!--end::Posts-->
        </div>
        <!--end::Latest posts-->
        <div class="col-12 mt-2">
            <div class="input-group">
                <button type="button" class="btn btn-sm btn-light-success mr-2" wire:click.prevent="publishInfo">
                    Publica Alterações
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                elementInit();
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
                elementInit();
            })
        });
        elementInit();

        function elementInit() {
            $('#selectTipoViewsContext').select2().on('change', () => {

                const ele = $('#selectTipoViewsContext').select2("val");
                @this.
                set('tipoViewsT', ele);

            });
        }


        window.addEventListener('send-success', evt => {
            toastr.success(evt.detail.message);

        })

    </script>
@endpush


