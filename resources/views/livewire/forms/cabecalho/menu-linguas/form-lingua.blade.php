<div>
    <form>
        <div class="card-body">
            <div class="row">

                <div class="col-12 col-sm-3">
                    <div class="form-group mb-5">
                        <label>{{ $cabecalho['language'] }} <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" data-control="select2"
                                wire:model.defer="data.context"
                                id="select-lange"
                                data-placeholder="Select an option">
                            <option></option>
                            <option value="Pt">Portugues</option>
                            <option value="Eng">Inglês</option>
                            <option value="Fr">Francês</option>
                        </select>
                        <span class="form-text text-muted">É importante seleccionar a língua.</span>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group mb-5">
                        <label>{{ $cabecalho['header_main'] }} <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" data-control="header_main"
                                wire:model.defer="data.listLange"
                                id="header_main"
                                data-placeholder="Seleciona o cabeçalho associado">
                            <option></option>
                            @foreach($select_header as $item)
                                <option
                                    value="{{__($item->id)}}">{{ $item->date_region . ' - Estado: ' . __($item->status?'Activado':'Pendente') }}</option>
                            @endforeach


                        </select>
                        <span class="form-text text-muted">É importante seleccionar o cabeçalho associado.</span>
                    </div>
                </div>

                <div class="col-12 col-sm-12">
                    <div class="form-group mb-3" wire:ignore>
                        <label>{{ $cabecalho['note'] }}</label>
                        <div type="text" class="form-control " id="doc_text_editor"></div>
                        <span class="form-text text-muted">Não é de grande importancia inserir observações</span>
                    </div>

                </div>

                <div class="col-12 mt-2">
                    <div class="input-group text-right justify-content-end">
                        <button type="button" class="btn btn-sm btn-light-primary mr-2" wire:click.prevent="saveInfo">
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

        @include('comuns.doc-config', ['className'=>'doc_text_editor'])

        watchdog.setCreator((element, config) => {
            return CKSource.Editor.create(element, config)
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.
                        set('data.observation', editor.getData())
                    })
                    console.log(editor);
                    return editor;
                })
        });
        initSelect();
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initSelect()
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
                initSelect()
            })
        });

        function initSelect() {
            $('#select-lange').select2()
                .on('change', function () {

                    // this.selectedOptions[0].text
                    let context = $('#select-lange').select2("data")[0].text;

                    let dataSelect = $('#select-lange').select2("val");
                    @this.
                    set('data.context', dataSelect);

                    @this.
                    set('data.designation', context)
                });

            $('#header_main').select2().on('change', function (e) {

                let dataSelect = $('#header_main').select2("val");
                @this.
                set('data.listLange', dataSelect);
            });
        }


        window.addEventListener('send-success', event => {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toastr-bottom-center",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "600",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.success(event.detail.message);
        })

        window.addEventListener('init-component', function () {
            initSelect();
        })


    </script>
@endpush
