<div>
    <form>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-7 mb-4">
                    <div class="form-group mb-3">
                        <label class="required">Titulo</label>
                        <input type="text" class="form-control form-control-sm" wire:model.defer="data.title"
                               placeholder="Introduza aqui a zona"/>
                        <span
                            class="form-text text-muted">O preenchimento da informação do rodapé.</span>
                    </div>
                </div>

                <div class="col-12 col-sm-12 mb-4">
                    <div class="form-group mb-3">
                        <label class="required">Conteudo</label>
                        <textarea type="text" class="form-control form-control-sm" wire:model.defer="data.context"
                                  placeholder="Introduza aqui a zona"></textarea>
                        <span
                            class="form-text text-muted">O preenchimento da informação do rodapé.</span>
                    </div>


                </div>


                <div class="col-12 mt-3">
                    <div class="input-group ">
                        <button type="button" class="btn btn-sm btn-primary mr-2" wire:click.prevent="saveJosonNotiy">
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
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                $('.selectorBoot').selectpicker();
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
                $('.selectorBoot').selectpicker();
            })
        });

        $('#selectIcon').on('change', function (e) {

            $('#viewIcon').removeClass().addClass($('#selectIcon').select2("val"))
        });

        window.addEventListener('errorEvernt', evt => {
            toastr.info(evt.detail.message);
        })
        window.addEventListener('showInfo', evt => {
            toastr.error(evt.detail.message);
        })

        window.addEventListener('showSuccess', evt => {
            toastr.success(evt.detail.message);
        })
    </script>
@endpush
