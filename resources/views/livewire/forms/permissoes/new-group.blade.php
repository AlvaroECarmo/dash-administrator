<div>
    <form id="headerForms">
        <div class="card-body mb-0 pb-2">
            <div class="row">
                <div class="col-12 col-sm-2 mb-10">
                    <div class="form-check form-check-custom me-9 border-bottom ">
                        <input class="form-check-input " id="personalize"
                               type="checkbox" wire:model="personalize">
                        <label class="form-check-label ms-3" for="personalize">
                            Personalizar o Grupo</label>
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-10">

                    <div class="form-group mb-3">
                        {{--@dump($departa,$departaKeys)--}}
                        <label
                            class="badge-light-info font-weight-light text-black required "
                            style="padding-right: 20px; padding-left: 10px">
                            &nbsp;Nome
                        </label>
                        @if(!$personalize)
                            <select
                                class="form-select form-select-sm @error('departamentoName') is-invalid @enderror"
                                id="departamento" multiple
                                wire:model="departaKeys">
                                @foreach($departaKeys as $is)
                                    <option value="{{ $is }}">
                                        {{ $this->departamento($is) }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input class="form-control form-control-sm" placeholder="insira qui o nome do grupo"
                                   type="text" wire:model="inputName">
                        @endif
                        {{-- informa--}}
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-6 mb-5">
                    <!--begin::Wrapper-->
                    <label
                        class="badge-light-success font-weight-light text-black required "
                        style="padding-right: 20px; padding-left: 10px">Permições</label>
                    <div class="d-flex fw-bold form-control form-control-sm pb-0">

                        <div class="form-check form-check-custom me-9 border-bottom ">
                            <input class="form-check-input " id="create" type="checkbox" wire:model="data.create">
                            <label class="form-check-label ms-3" for="create">Criar</label>
                        </div>

                        <div class="form-check form-check-custom me-9 border-bottom ">
                            <input class="form-check-input " id="remove" type="checkbox" wire:model="data.remove">
                            <label class="form-check-label ms-3" for="remove">Eliminar</label>
                        </div>

                        <div class="form-check form-check-custom me-9 border-bottom ">
                            <input class="form-check-input " type="checkbox" id="update" wire:model="data.update">
                            <label class="form-check-label ms-3" for="update">Actualizar</label>
                        </div>
                        <div class="form-check form-check-custom me-9 border-bottom ">
                            <input class="form-check-input  " type="checkbox" id="publish" wire:model="data.publish">
                            <label class="form-check-label ms-3" for="publish">Publicar</label>
                        </div>
                        <div class="form-check form-check-custom me-9 border-bottom ">
                            <input class="form-check-input mb-1" type="checkbox" id="read" wire:model="data.read"
                                   checked="checked">
                            <label class="form-check-label ms-3" for="read">Leitura</label>
                        </div>


                    </div>
                    <!--end::Wrapper-->
                </div>
                <div class="col-12 row">
                    <div class="col-12 col-sm-4">
                        <div class="form-group mb-3">
                            <label class="required">Estado</label>
                            <select class="form-select form-select-sm selector" wire:model="data.status"
                                    data-control="select2"
                                    id="statusSelector" data-placeholder="Selecciona o estado">
                                <option></option>
                                <option value="true">Activos</option>
                                <option value="false">Pendentes</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-12 col-sm-8">
                        <div class="form-group mb-3">
                            <label class="required">Menus</label>
                            <select class="form-select form-select-sm selector rounded-start-0" multiple
                                    data-control-icon="select2"
                                    id="selectIcon" wire:model="arraySelect"
                                    data-placeholder="Seleccione a views">
                                <option></option>
                                @foreach($listMenus as $m)
                                    <option value="{{ $m['key'] }}">{{ $m['name'] }}</option>
                                @endforeach
                            </select>
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
                            Guardar a informação
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@push('scripts')
    <script>

        initSelectorANDOA()

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                try {
                    initSelectorANDOA();
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

                    initSelectorANDOA();
                } catch (e) {

                }

            })
        });


        function initSelectorANDOA() {
            $(document).ready(function () {

                $("#statusSelector").select2({
                    minimumResultsForSearch: -1
                }).on('change', (e) => {
                    @this.
                    set('data.status', $("#statusSelector").select2("val"));
                });

                $("#selectIcon").select2().on('change', (e) => {
                    const valueSelect = $("#selectIcon").val()
                    @this.set('arraySelect', valueSelect)
                });

                $("#departamento").select2({
                    language: "pt",
                    allowClear: true,
                    placeholder: 'Pesquise aqui o departamento',
                    minimumInputLength: 1,
                    ajax: {
                        url: '{{ route("api.department")}}',
                        dataType: 'json',
                    },

                }).on('change', () => {
                    @this.
                    set('departamento.departmentName', $('#departamento').select2('data')[0].text);
                    @this.
                    set('departaKeys', $('#departamento').select2('val'));
                });


            });
        }

        window.addEventListener('send-success', event => {
            toastr.success(event.detail.message);

        })


        window.addEventListener('init-Component', event => {
            $('#selectIcon').select2();
            $('#statusSelector').select2();
        })


    </script>
@endpush
