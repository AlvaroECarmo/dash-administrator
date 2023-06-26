<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <!--begin::Heading-->
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <!--begin::Label-->
        <span class="fs-4 fw-bolder pe-2">Slider Publicados</span>
        <!--end::Label-->
    </div>
    <!--end::Heading-->
    <div class="py-5">
        <div class="rounded border p-10">

            <div id="kt_carousel_1_carousel" class="carousel carousel-custom slide" data-bs-ride="carousel"
                 data-bs-interval="8000">
                <!--begin::Carousel-->
                <div class="carousel-inner pt-8">
                    <!--begin::Item-->
                    @foreach($sliders as $slider)
                        @if($loop->iteration == 1)
                            @livewire('forms.banner-central.slider.item-slider', ['activeVal'=>'active', 'title'=>$slider->h1, 'data' => $slider,'$slider'=> $slider])
                        @else
                            @livewire('forms.banner-central.slider.item-slider', ['title'=>$slider->h1, 'data' => $slider, 'slider'=> $slider])
                        @endif
                    @endforeach

                    <!--end::Item-->
                </div>
                <!--end::Carousel-->
                <!--begin::Heading-->
                <div class="d-flex align-items-center justify-content-end flex-wrap">
                    <!--begin::Label-->
                    <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                        @foreach($sliders as $slider)
                            @if($loop->iteration == 1)
                                <li data-bs-target="#kt_carousel_1_carousel" data-bs-slide-to="0"
                                    class="ms-1 active"></li>
                            @else
                                <li data-bs-target="#kt_carousel_1_carousel"
                                    data-bs-slide-to="{{  $loop->iteration - 1 }}"
                                    class="ms-1">
                                </li>
                            @endif

                        @endforeach
                    </ol>
                    <!--end::Carousel Indicators-->
                </div>
                <!--end::Heading-->
            </div>

            <div class="col-12 mt-2">
                <div class="input-group">
                    <button type="button" class="btn btn-sm btn-light-success mr-2" wire:click.prevent="infoPublish">
                        Publica Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- success-event-sub --}}
@push('scripts')
    <script>

        document.addEventListener("DOMContentLoaded", () => {

            Livewire.hook('component.initialized', (component) => {
            })
            Livewire.hook('element.initialized', (el, component) => {
            })
            Livewire.hook('element.updating', (fromEl, toEl, component) => {
                listeners()
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


        function listeners() {
            window.addEventListener('publicSlider', evt => {

                toastr.success('As informações da pagina de inicio foi publicado com sucesso!');

            })
        }
        window.addEventListener('success-event-sub', evt => {

            toastr.success('As informações da pagina de inicio foi publicado com sucesso!');

        })

    </script>
@endpush
