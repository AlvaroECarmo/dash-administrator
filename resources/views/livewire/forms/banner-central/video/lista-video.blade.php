<div>
    <div class="card-body p-lg-10">
        <!--begin::Latest posts-->
        <div class="mb-15">
            <!--begin::Posts-->
            <div class="row g-10">
                @foreach($iframs as $item)

                    <div class="col-12 col-sm-4 mb-6">
                        <div class="card-xl-stretch me-md-6">

                            <span class="d-block overlay" data-fslightbox="lightbox-hot-sales">

                                <div
                                    class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image:url('{{$item->details }}')"></div>

                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <span class="btn btn-sm btn-light-info"
                                          wire:click.prevent="destacarEste({{ $item }})">
                                        Destacar Este
                                    </span>
                                </div>


                            </span>

                            <div class="mt-5">

                                <a href="#proximo passo"
                                   class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">
                                    {{ \Illuminate\Support\Str::limit($item->title, $limit = 40, $end = ' ...')  }}
                                </a>

                                <div class="font-weight-light fs-5 text-gray-600 my-3 h-35px">
                                    {{ \Illuminate\Support\Str::limit($item->context, $limit = 100, $end = ' ...')  }}
                                </div>

                            </div>

                        </div>

                    </div>

                    {{--  <div class="col-md-3 gap-2"   >
                          <!--begin::Feature post-->

                          <div class="card-xl-stretch ms-md-6">
                          <!--begin::Body-->
                              <img src="{{$item->details}}" alt="">
                              <div class="mt-5"  >
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
                                      {!!   $item->context !!}
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
                                      <div class="row">
                                      <span
                                          class="badge badge-light-warning fw-bolder my-2 p-2 btn btn-sm btn-light-danger"
                                          style="cursor: pointer" wire:click.prevent="deleteElement({{ $item }})"><i
                                              class="fa fa-trash"></i> </span>
                                      </div>
                                      <!--end::Label-->
                                  </div>
                              </div>
                              <!--end::Body-->
                          </div>
                          <!--end::Feature post-->
                      </div>--}}
                @endforeach
                <div class="justify-content-end float-right">
                    {{ $iframs->links() }}
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

        window.addEventListener('confirm-event', evt => {
            confirmSwit(evt.detail.message).then((result) => {
                if (result.isConfirmed) {
                    @this.
                    set('confirm', true)
                }
            });
        })

    </script>
@endpush
