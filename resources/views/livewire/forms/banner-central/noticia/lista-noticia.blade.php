<div>
    <div class="card-body p-0 ">
        <!--begin::Latest posts-->
        <div class="mb-15 mt-5">

            <div class="row">
                <div class="col-12 col-sm-2">
                    <input class="form-control text-right form-control-solid form-control-sm"
                           placeholder="Intervalo de data"
                           id="kt_daterangepicker_4"/>

                    <input type="text" hidden id="dataInicial" wire:model="dataInicial">
                    <input type="text" hidden id="dataFinalFilro" wire:model="dataFinalFilro">
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control form-control-sm"
                               placeholder="Pesquisar pelo titulo" wire:model="titleInfor"/>
                    </div>
                </div>
            </div>
            <!--begin::Posts-->
            <div class="row g-10 " wire:sortable="updateTaskOrder">
                @foreach($aboutSection as $item)
                    <div class="col-md-4 col-sm-4 col-12 p-0" wire:sortable.item="{{ $item->id }}"
                         wire:key="item-{{ $item->id }}">

                        <div class="card-xl-stretch ms-md-6">

                            <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                               href="{{ __($item->img?('storage/'. $item->img):'/assets/about-1.jpg') }}">

                                <div
                                    class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    @if(!$item->img)
                                    style="background-image:url({{ __('/assets/about-1.jpg') }})"
                                    @else
                                    style="background-image:url({{ __('storage/'. $item->img) }})"
                                    @endif></div>

                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="fa fa-eye fs-2x text-white"></i>
                                </div>


                            </a>

                            <div class="mt-5">

                                <a href="#"
                                   class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">
                                    <div style="width: 94%; overflow: hidden;
                                        text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $item->context }}
                                    </div>
                                </a>

                                <div class="fw-bold fs-5 text-gray-600 my-3"
                                     style="overflow: hidden; max-height: 100px; height: 72px; border:1px; text-overflow: ellipsis;">
                                    {!!   $item->destaque!!}
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

                                        <span
                                            class="badge badge-light-info fw-bolder py-2"
                                            style="cursor: pointer"
                                            wire:click.prevent="editarConteudo({{ $item }})"><i
                                                class="fa fa-edit"></i> </span>

                                        <span
                                            class="badge badge-light-danger fw-bolder py-2"
                                            style="cursor: pointer"
                                            wire:click.prevent="removeItem({{ $item }})"><i
                                                class="fa fa-trash"></i> </span>
                                        <span class="badge badge-light-warning fw-bolder my-2 btn btn-sm btn-light-info"
                                              style="cursor: pointer" wire:sortable.handle> Ordenar</span>

                                    </span>
                                    <!--end::Label-->
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                @endforeach
                <div class="">
                    <div class="float-right">
                        {{ $aboutSection->links() }}
                    </div>
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

        var start = moment().subtract(29, "days");
        var end = moment();


        function cb(start, end) {
            $("#kt_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_daterangepicker_4").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Hoje': [moment(), moment()],
                'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                'Este mês': [moment().startOf('month'), moment().endOf('month')],
                'Mês anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Neste Ano': ['01-01-' + moment().year, '31-12-' + moment().year],
                'Ano Anterior': ['01-01-' + (moment().subtract(1, 'years').year() ), '31-12-' + (moment().subtract(1, 'years').year())],

            },
            locale: {
                "format": "DD-MM-YYYY",
                "separator": " & ",
                "applyLabel": "Definir",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "Até",
                "customRangeLabel": "Configurar",
                "weekLabel": "S",
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
            },

        }, (start, end) => {
            $('#dataFinalFilro').val(end.format('DD-MM-YYYY'));
            $('#dataInicial').val(start.format('DD-MM-YYYY'));

            document.getElementById("dataFinalFilro").dispatchEvent(new Event('input'));
            document.getElementById("dataInicial").dispatchEvent(new Event('input'));
        });


    </script>
@endpush
