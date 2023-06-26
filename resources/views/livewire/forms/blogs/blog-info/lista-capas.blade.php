<div>
    <div class="">

        <div class="row ">

            <div class="form-group col-6">
                <input class="form-control form-control-sm " placeholder="Encontrar a capa pelo titulo" type="text"
                       wire:model="event.serchble">
            </div>

        </div>
        <div class="row g-10 row-cols-2 row-cols-lg-5">

            @foreach($capas as $capa)
                <div class="h-100 d-flex flex-column justify-content-between pe-xl-6 mb-xl-0 mb-10">
                    <!--begin::Wrapper-->
                    <div class="overlay mt-2">
                        <!--begin::Image-->
                        <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
                             style="background-image:url('{{ Storage::url($capa->imgCapa) }}')"></div>
                        <!--end::Image-->
                        <!--begin::Links-->
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                            <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                               href="{{ Storage::url($capa->imgCapa) }}">
                                <span class="badge badge-light-warning">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </a>
                            &nbsp;
                            <span class="badge badge-light-danger"
                                  wire:click.prevent="removeElement({{ $capa }})">
                                <i class="fa fa-trash "></i>
                            </span>
                            &nbsp;
                            <span class="badge badge-light-success">
                                <input type="radio" name="informatio"
                                       class="cursor-pointer form-check-sm radioInfor"
                                       wire:change.prevent="publicMyCapa(event.target.value, {{ $capa }})">
                            </span>
                            &nbsp;
                            <span class="badge badge-light-danger cursor-pointer"
                                  wire:click.prevent="editElement({{ $capa }})">
                                <i class="fa fa-edit "></i>
                            </span>

                        </div>

                        <!--end::Links-->
                    </div>
                    <!--end::Wrapper-->
                    <span>{{ substr($capa->title,0,40) }} ...</span>
                </div>
            @endforeach

        </div>
        <!--begin::Row-->
        <div class="mt-4 d-flex justify-content-end">
            {{ $capas->links() }}
        </div>

    </div>
</div>
@push('scripts')
    <script>

        initRadio();
        const laraberg = Laraberg;

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initRadio();
                initSelector();
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
                initSelector();
            })
        });

        function initRadio() {
            $(".radioInfor").attr("checked", false);
        }





        $('#buttorns').on('click', function () {
            // const content = Laraberg.getContent() + yourData
            // Laraberg.setContent(content)
            Laraberg.wordpress.blockEditor
            Laraberg.wordpress.blocks
            Laraberg.wordpress.components
            Laraberg.wordpress.data
            Laraberg.wordpress.element
            Laraberg.wordpress.hooks
            Laraberg.wordpress.serverSideRender


            $("dataPost")
            console.log(laraberg)

        })

    </script>
@endpush
