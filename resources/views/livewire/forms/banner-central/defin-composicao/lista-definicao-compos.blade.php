<div>
    <div class="card-body p-lg-10">
        <!--begin::Latest posts-->
        <div class="mb-15">


            <!--begin::Posts-->
            <div class="row g-10" wire:sortable="updateTaskOrder">
                @foreach($aboutSection as $item)
                    <div class="col-md-4" wire:sortable.item="{{ $item->id }}" wire:key="item-{{ $item->id }}">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch ms-md-6">
                            <!--begin::Overlay-->
                            <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                               href="{{ __($item->imageBox?('storage/'. $item->imageBox->image):'/assets/about-1.jpg') }}">
                                <!--begin::Image-->
                                <div
                                    class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    @if(!$item->imageBox)
                                    style="background-image:url({{ __('/assets/about-1.jpg') }})"
                                    @else
                                    style="background-image:url({{ __('storage/'. $item->imageBox->image) }})"
                                    @endif></div>
                            <!--end::Image     style="background-image:url(' {{ __($item->imageBox?('storage/'. $item->imageBox->image):'/assets/about-1.jpg') }}')" -->
                                <!--begin::Action-->
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
                                    <div
                                        style="width: 94%; overflow: hidden;text-overflow: ellipsis; white-space: nowrap; ">{{ $item->title }}</div>
                                </a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-bold fs-5 text-gray-600 my-3"
                                     style="overflow: hidden; max-height: 100px; height: 72px; border:1px; text-overflow: ellipsis;">
                                    {!!   $item->subTitle . ' - ' . $item->h5!!}
                                </div>
                                <!--end::Text-->
                                <!--begin::Content-->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="fs-6 fw-bolder">
                                        <!--begin::Date-->
                                        <span
                                            class="text-gray-500">{{ Date::parse($item->created_at)->format('d, M Y') }}</span>
                                        <!--end::Date-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Label-->
                                    <span>
                                        <span class="badge badge-light-warning fw-bolder my-2 btn btn-sm btn-light-info"
                                              style="cursor: pointer" wire:sortable.handle><i
                                                class="fa fa-truck-moving"></i> Ordenar</span>
                                        <span
                                            class="badge badge-light-warning fw-bolder my-2 btn btn-sm btn-light-danger"
                                            style="cursor: pointer" wire:click.prevent="removeItem({{ $item }})"><i
                                                class="fa fa-trash"></i> Remover</span>
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
                    {{ $aboutSection->links() }}
                </div>
                <!--begin::Col-->
            </div>
            <!--end::Posts-->
        </div>
        <!--end::Latest posts-->
        <div class="col-12 mt-2">
            <div class="input-group">
                <button type="button" class="btn btn-sm btn-light-success mr-2" wire:click.prevent="moverImgPublish">
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
