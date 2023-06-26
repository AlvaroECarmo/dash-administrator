<div>
    <div class="card-body p-lg-10">
        <!--begin::Latest posts-->
        <div class="mb-15">
            <!--begin::Posts-->
            <div class="row g-10">
                @foreach($blogPagBody as $item)
                    <div class="col-md-12">
                        <!--begin::Feature post-->
                        <span class="badge badge-primary text-white badge-circle"
                              wire:click.prevent="sentCapa({{$item}})"
                              style="margin-top: -50px!important; margin-left: 15px; margin-bottom: 5px; cursor: pointer; ">
                            <i class="fa fa-edit text-white"></i>
                        </span>
                        <div class="card-xl-stretch ms-md-6">
                            <!--begin::Overlay-->

                            <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                               href="{{ __(Storage::url($item->imgCapa)) }}">
                                <!--begin::Image-->
                                <div
                                    class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    @if(!Storage::url($item->imgCapa))
                                        style="background-image:url({{ __('/assets/about-1.jpg') }})"
                                    @else
                                        style="background-image:url({{ __(Storage::url($item->imgCapa)) }})"
                                    @endif>

                                </div>

                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="fa fa-eye fs-2x text-white"></i>
                                </div>
                                <!--end::Action-->
                            </a>

                            <!--begin::Body-->

                            <div class="mt-5">
                                <!--begin::Title-->
                                <div class="fw-bolder">
                                    <span class="text-uppercase">{{ $item->title }}</span>
                                </div>
                                <div class="card-body pt-6">
                                    <!--begin::Timeline-->
                                    <div class="timeline-label">
                                        @foreach($item->blogPageBody as $oe)

                                            <div class="timeline-item">
                                                <!--begin::Label-->
                                                <div
                                                    class="timeline-label fw-bolder text-gray-800 fs-6">{{ Date::parse($oe->updated_at)->format('H:i') }}</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="fa fa-genderless text-danger fs-1"></i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Desc-->
                                                <div class="timeline-content  text-gray-800 ps-3">
                                                    <p class="fw-bolder">{{ $oe->title }}</p>
                                                    <span class="font-weight-light">{!! substr($oe->context, 0,1402) !!} ...</span>
                                                    <div>
                                                        <span class="badge badge-light-info fw-bolder py-2"
                                                              style="cursor: pointer"
                                                              wire:click.prevent="editItemElemente({{ $oe }})">
                                                            <i class="fa fa-edit text-info"></i>
                                                        </span>
                                                        <span class="badge badge-light-danger fw-bolder py-2"
                                                              style="cursor: pointer"
                                                              wire:click.prevent="removeItemElemente({{ $oe }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end::Desc-->
                                            </div>
                                        @endforeach
                                    </div>
                                    <!--end::Timeline-->
                                </div>


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
                                            <i class="fa fa-trash text-danger"></i>
                                        </span>
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
                    Publicar Alterações
                </button>


            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initClassic();
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


        window.addEventListener('send-success', evt => {
            toastr.success(evt.detail.message);

        })

    </script>
@endpush

