<div>
    <div class="row g-10 row-cols-2 row-cols-lg-12 ">


        <div class="form-group mb-3 col-sm-2 col-12" wire:ignore>

            <input class="form-control form-control-solid form-control-sm" placeholder="Intervalo de data"
                   id="kt_daterangepicker_4"/>

            <input type="text" hidden id="dataInicial" wire:model="dataInicial">
            <input type="text" hidden id="dataFinalFilro" wire:model="dataFinalFilro">
        </div>

        <div class="form-group mb-3 col-sm-3 col-12">
            <input type="text" class="form-control form-control-sm" wire:model="search"
                   placeholder="buscar a informação do deputado pelo nome">

        </div>

        <div class="form-group mb-3 col-sm-3 col-12" wire:ignore>
            <select class="form-select form-select-sm
                @error('cargoName') is-invalid @enderror"
                    id="cargosTY" wire:model="cargoIDTDS">
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
                                            class="font-weight-light text-dark badge badge-light-success">
                                            @isset($capa->cargoText)
                                                {{ __($capa->cargoText) }}
                                            @else
                                                Cargo não encontrado!
                                            @endif
                                        </span> <br>
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

    {{--   <!--     {{ $capas->links() }}-->--}}

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

            $('#cargosTY').select2({
                language: "pt",
                placeholder: 'Filtrar pelo cargo',
                allowClear: true,
            }).on('change', () => {

                const eleES = $('#cargosTY').select2("val")
                const eleTextER = $('#cargosTY').select2('data')[0].text

                @this.set('cargoIDTDS', eleES)
                @this.set('cargoTextERS', eleTextER)
            });

            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        }


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
                'Neste Ano': ['01-01-' + moment().year() , '31-12-' + moment().year()],
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
