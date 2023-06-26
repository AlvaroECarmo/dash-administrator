<div>
    <form id="headerForms">
        <div class="card-body mb-0 pb-2">
            <div class="row">
                <div class="col-12 col-sm-6 mb-10">
                    <div class="form-group mb-3">
                        <label
                            class="badge-light-info font-weight-light text-black required "
                            style="padding-right: 20px; padding-left: 10px">Nome</label>
                        <select multiple class="form-select form-select-sm @error('primaryEmail') is-invalid @enderror"
                                id="entidade" wire:model="funcionario">

                            @foreach( $funcionario as $e)
                                <option value="{{ $e }}">
                                    {{ $this->funcionario($e) }}
                                </option>
                            @endforeach

                        </select>
                        {{-- informa--}}
                    </div>
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
                            <label class="required">Membro de.</label>
                            <select class="form-select form-select-sm selector rounded-start-0" {{--multiple--}}
                                    data-control-icon="select2"
                                    id="selectIconRE" wire:model="valueSelectE"
                                    data-placeholder="Seleccione a views">
                                <option></option>
                                @foreach($listGroups as $m)
                                    <option value="{{ $m['id'] }}">{{ $m['name'] }}</option>
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

        initSelectorES()

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                try {
                    initSelectorES();
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

                    initSelectorES();
                } catch (e) {

                }

            })
        });


        function initSelectorES() {
            $(document).ready(function () {

                $("#statusSelector").select2({minimumResultsForSearch: -1}).on('change', (e) => {
                    @this.
                    set('data.status', $("#statusSelector").select2("val"));
                });

                $("#selectIconRE").select2().on('change', (e) => {
                    const valueSelectE = $("#selectIconRE").val()
                    @this.set('valueSelectE', valueSelectE)
                });
            });

            $("#entidade").select2({
                language: "pt",
                placeholder: 'Pesquise aqui a Entidade',
                allowClear: true,
                minimumInputLength: 1,
                ajax: {
                    url: '{{ route("api.funcionario")}}',
                    dataType: 'json',
                },

            }).on('change', () => {
                const entidade = $('#entidade').select2('val')
                @this.set('funcionario', entidade);
                //const entidadeText = $('#entidade').select2('data')[0].text;

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
