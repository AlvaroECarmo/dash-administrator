<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <!-- Form para a criação de Menu  -->
    <div class="form-group p-2">
        <div data-repeater-list="kt_docs_repeater_basic">
            <div data-repeater-item>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label class="form-label">Titulo</label>
                        <input type="text" class="form-control form-control-sm mb-2 mb-md-0"
                               wire:model.defer="data.context"
                               placeholder="Escreve o titilo da rede social"/>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Link / Url</label>
                        <input type="text" class="form-control form-control-sm mb-2 mb-md-0"
                               wire:model.defer="data.url"
                               placeholder="Escreve a url do conteúdo"/>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Classificação<span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-sm selector mb-2 mb-md-0 " data-menu-selector="select2"
                                wire:model.defer="data.classificacao" id="classificacao" data-hide-search="false"
                                data-placeholder="Seleciona a classificação de conteúdo">
                            <option></option>
                            <option value="/">Link de acesso interno</option>
                            <option value="https">Link de acesso externo certificado</option>
                            <option value="http">Link de acesso externo não certificado</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Estado<span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-sm selector mb-2 mb-md-0 " data-element="select2"
                                wire:model.defer="data.status" id="estado" data-hide-search="false"
                                data-placeholder="Selecciona o tipo de conteudo">
                            <option></option>
                            <option value="true">Active</option>
                            <option value="false">Pendente</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button type="button"
                                wire:click.prevent="saveElement"
                                class="btn btn-sm btn-primary mt-3 mt-md-8 btn-sm btn-block">
                            Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
    <script>
        initSelector();
        document.addEventListener("DOMContentLoaded", () => {

            Livewire.hook('component.initialized', (component) => {
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


        function initSelector() {

            $('#classificacao').select2().on('change', function () {
                let data = $('#classificacao').select2("val")
                    // $("#imagsItem").attr("src", data);

                    @this.set('data.tipo', data)
            });
            $('#estado').select2().on('change', function () {
                let data = $('#estado').select2("val")
                    // $("#imagsItem").attr("src", data);

                    @this.set('data.icon', data)
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
    </script>
@endpush
