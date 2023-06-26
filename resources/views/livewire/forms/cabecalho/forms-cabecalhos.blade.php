<div>
    <form id="headerForms">
        <div class="card-body mb-0 pb-2">
            <div class="row">
                <div class="col-12 col-sm-6 mb-10">
                    <div class="form-group mb-3">
                        <label
                            class="badge-light-success font-weight-light text-black required "
                            style="padding-right: 20px; padding-left: 10px">Titulo</label>
                        <input type="text" class="form-control form-control-solid form-control-sm"
                               wire:model.lazy="data.date_region"
                               placeholder="Introduza aqui a zona"/>
                        {{-- informa--}}
                        <span
                            class="form-text text-muted">{{ config('ao.cabecalho.cabecalho.form.TimeZoneRequire') }}</span>
                    </div>
                </div>
                <div class="col-12 row">
                    <div class="col-12 col-sm-4">
                        <div class="form-group mb-3">
                            <label class="required">{{ $cabecalho['statuSelector']}}</label>
                            <select class="form-select form-select-sm selector" wire:model="data.status"
                                    data-control="select2"
                                    id="statusSelector" data-placeholder="Selecciona o estado">
                                <option></option>
                                <option value="true">Activos</option>
                                <option value="false">Pendentes</option>
                            </select>
                            <span class="form-text text-muted">é importante selecionar o estado do cabeçalho</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group mb-3">
                            <label class="required">{{ $cabecalho['iconSelector']}}</label>

                            <div class="input-group flex-nowrap">
                                <i class=""></i>
                                <span class="input-group-text"><i class="{{$icon_region}}"></i></span>
                                <div class="overflow-hidden flex-grow-1">
                                    <select class="form-select form-select-sm selector rounded-start-0"
                                            data-control-icon="select2"
                                            id="selectIcon" wire:model="data.icon_region"
                                            data-placeholder="Seleccione o icone">
                                        <option></option>
                                        <option value="fab fa-google">fab fa-google</option>
                                        <option value="fab fa-google-plus">fab fa-google-plus</option>
                                        <option value="fas fa-phone">fas fa-phone</option>
                                        <option value="fas fa-home">fas fa-home</option>
                                        <option value="flaticon-sunny-day-or-sun-weather">Tempo actual</option>
                                        <option value="fa fa-envelope">Envelope</option>
                                        <option value="fa fa-user">Utilizador</option>
                                    </select>
                                </div>
                            </div>


                            <span
                                class="form-text text-muted">{{ config('ao.cabecalho.cabecalho.form.iconRequire') }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group mb-2">
                            <label class="required">{{ $cabecalho['datetime'] }}</label>
                            <input type="text" class="form-control form-control-sm"
                                   value="{{ date('d') .' de '. date('M Y') . ', as '. date('H:i.s')  }}"
                                   placeholder="Data actual de inserção" disabled/>
                            <span
                                class="form-text text-muted">{{ config("ao.cabecalho.cabecalho.form.dateLocalRequire") }}</span>
                        </div>
                    </div>

                </div>

                {{--
                    <div class="col-12 col-sm-12">
                        @livewire('form.comuns.contact-ende-redes')
                    </div>
                 --}}
                <div class="col-12 mt-2">
                    <div class="input-group text-right justify-content-end">
                        <button type="button" class="btn btn-sm btn-light-primary mr-2" wire:click.prevent="sendInfo">
                            Guardar
                            a
                            informação
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@push('scripts')
    <script>

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                try {
                    initSelector();
                } catch (e) {
                }

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
                try {

                    initSelector();
                } catch (e) {

                }

            })
        });


        $(document).ready(function () {

            initSelector()

            function initSelector() {

                $("#statusSelector").select2().on('change', (e) => {
                    @this.
                    set('data.status', $("#statusSelector").select2("val"));
                });

                $("#selectIcon").select2().on('change', (e) => {
                    @this.
                    set('data.icon_region', $("#selectIcon").select2("val"));
                    @this.
                    set('icon_region', $("#selectIcon").select2("val"));
                });

            }
        });


        window.addEventListener('send-success', event => {
            toastr.success(event.detail.message);

        })


        window.addEventListener('init-Component', event => {
            $('#selectIcon').select2();
            $('#statusSelector').select2();
        })


    </script>
@endpush
