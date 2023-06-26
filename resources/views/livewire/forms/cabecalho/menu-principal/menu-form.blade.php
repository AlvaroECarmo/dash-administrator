<div>
    <form>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-10 mb-10">
                    <label class="badge badge-light-primary">Seleciona o item Pai</label>
                    <select class="form-select form-select-sm" id="parentItemMenu"
                            wire:model.defer="data.elements"
                            data-allow-clear="true" data-control="select2"
                            data-placeholder="Seleciona o item menu parente">
                        <option></option>
                        @foreach($mainMenu as $e)
                            <option value="{{ $e->id }}">{{ ucfirst(mb_strtolower($e->context)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-sm-3">
                    <div class="form-group mb-3">
                        <label>{{ $cabecalho['title'] }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" wire:model="data.context"
                               placeholder="Introduza aqui o titulo"/>
                        <span class="form-text text-muted">Deve escrever o titulo do menu.</span>
                    </div>
                </div>

                <div class="col-12 col-sm-3">
                    <div class="form-group mb-3">
                        <label>{{ $cabecalho['link'] }}<span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm " wire:model="data.url"
                               placeholder="Introduza aqui a url / link"/>

                        <span class="form-text text-muted">Deve indicar a routa ou menu</span>
                    </div>
                </div>


                <div class="col-12 col-sm-3">
                    <div class="form-group mb-3">
                        <label>{{ $cabecalho['acessLink'] }} <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="keyMenuSelect"
                                wire:model="data.key" data-control="select2"
                                data-placeholder="Seleciona a Classificação do menu">
                            <option></option>
                            <option value="/">Link de acesso interno</option>
                            <option value="https">Link de acesso externo certificado</option>
                            <option value="http">Link de acesso externo não certificado</option>
                        </select>
                        <span class="form-text text-muted">Deve selecionar a classificação do menu</span>
                    </div>


                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group mb-2">
                        <label class="required">{{ $cabecalho['menuType'] }}</label>
                        <select class="form-select form-select-sm" id="classSelect"
                                wire:model="data.class" data-control="select2"
                                data-placeholder="Selecciona o tipo de Menu">
                            <option></option>
                            <option value="dropdown">Com acesso a sub menus</option>
                            <option value="notDropdown">Sem acesso a sub menus</option>
                            <option value="current">Link activo</option>

                        </select>
                        <span class="form-text text-muted">Deve selecionar o tipo de menu</span>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="input-group text-right justify-content-end">
                        <button type="button" class="btn btn-sm btn-light-primary mr-2 btn-sm"
                                wire:click.prevent="save_header">
                            Guardar a
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
                    initSector()
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
                    initSector()
                } catch (e) {

                }


            })
        });


        initSector()

        function initSector() {


            $('#keyMenuSelect').select2().on('change', function () {

                const ele = $('#keyMenuSelect').select2("val");

                @this.
                set('data.key', ele)
            });

            $('#classSelect').select2().on('change', function () {
                const ele = $('#classSelect').select2("val");

                @this.
                set('data.class', ele)
            });


            $('#parentItemMenu').select2().on('change', function () {
                const ele = $('#parentItemMenu').select2("val");


                @this.
                set('data.elements', ele)
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

        window.addEventListener('init-component', event => {
            alert('Ola como estas');
        })
    </script>
@endpush
