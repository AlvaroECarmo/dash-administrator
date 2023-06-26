<div>
    <form>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-7">
                    <div class="form-group mb-3">
                        <label>{{ $bannerCentral['title'] }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-select-sm" wire:model.defer="data.date_region"
                               placeholder="Introduza aqui a zona"/>
                        <span class="form-text text-muted">O preenchimento da zona é importante.</span>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group mb-3">
                        <label class="required badge badge-light-info">{{ $bannerCentral['iconSelector'] }}</label>
                        <div class="row" style="padding-left: 10px!important;">
                            <div class="col-1 btn  btn-light btn-sm text-center ">
                                <i class="" id="viewIcon"></i>
                            </div>
                            <div class="col-5 col-md-6 col-sm-4 col-xl-10 col-xxl-11 col-lg-11">
                                <select class="form-select form-select-sm" data-control="select2"
                                        wire:model_defer="data.icon_region"
                                        id="selectIcon" data-placeholder="Select an option">
                                    <option></option>
                                    <option value="fab fa-google">fab fa-google</option>
                                    <option value="fab fa-google-plus">fab fa-google-plus</option>
                                    <option value="fas fa-phone">fas fa-phone</option>
                                </select>
                            </div>
                        </div>

                        <span class="form-text text-muted">É importante selecionar o icone</span>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group mb-3">
                        <label>{{ $bannerCentral['statuSelector'] }}<span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" data-control="select2" wire:model_defer="data.status"
                                data-placeholder="Selecciona o estado">
                            <option></option>
                            <option value="1">Activos</option>
                            <option value="2">Pendentes</option>
                        </select>
                        <span class="form-text text-muted">é importante seleccionar o estado</span>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group mb-2">
                        <label>{{ $bannerCentral['datetime'] }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm"
                               value="{{ date('d') .' de '. date('M Y') . ', as '. date('H:i.s')  }}"
                               placeholder="Data actual de inserção" disabled/>
                        <span class="form-text text-muted">É importante selecionar o icone</span>
                    </div>
                </div>

                <div class="form-group mb-3 mt-2">
                    <label>S{{ $bannerCentral['note'] }} <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="kt_docs_ckeditor_classic " wire:model_defer="data.observation"
                              rows="5" id="kt_docs_ckeditor_classic"></textarea>
                </div>

                <div class="col-12 mt-2">
                    <div class="input-group text-right justify-content-end">
                        <button type="button" class="btn btn-primary mr-2" wire:click.prevent="save_header">Guardar a
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

        $('#selectIcon').on('change', function (e) {

            $('#viewIcon').removeClass().addClass($('#selectIcon').select2("val"))
        });
        KTUtil.onDOMContentLoaded((function () {
            ClassicEditor
                .create(document.querySelector('#kt_docs_ckeditor_classic'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        }));


        /* window.addEventListener('init-Component', event => {
             alert('Ola como estas');
         })*/
    </script>
@endpush
