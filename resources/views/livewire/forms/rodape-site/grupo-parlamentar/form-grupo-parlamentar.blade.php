<div>
    <form>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group mb-3">
                        <label>{{ $rodaPeSite['title']}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" wire:model.defer="data.date_region"
                               placeholder="Introduza aqui a zona"/>
                        <span
                            class="form-text text-muted">O preenchimento da zona é importante.</span>
                    </div>


                    <div class="form-group mb-3">
                        <label>{{ $rodaPeSite['iconSelector']}} <span
                                class="text-danger">*</span></label>
                        <div class="row" style="padding-left: 10px!important;">
                            <div class="col-1 btn btn-secondary text-center ">
                                <i class="" id="viewIcon"></i>
                            </div>
                            <div class="col-5 col-md-6 col-sm-4 col-xl-10 col-xxl-11 col-lg-11">
                                <select class="form-select" data-control="select2" id="selectIcon"
                                        data-placeholder="Select an option">
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
                <div class="col-12 col-sm-6">
                    <div class="form-group mb-3">
                        <label>{{ $rodaPeSite['statuSelector']}}<span
                                class="text-danger">*</span></label>
                        <select class="form-select" data-control="select2"
                                data-placeholder="Selecciona o estado">
                            <option></option>
                            <option value="1">Activos</option>
                            <option value="2">Pendentes</option>
                        </select>
                        <span class="form-text text-muted">é importante seleccionar o estado</span>
                    </div>
                    <div class="form-group mb-2">
                        <label>{{ $rodaPeSite['datetime']}} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control"
                               value="{{ date('d') .' de '. date('M Y') . ', as '. date('H:i.s')  }}"
                               placeholder="Data actual de inserção" disabled/>
                        <span class="form-text text-muted">É importante selecionar o icone</span>
                    </div>

                </div>
                {{--  <div class="col-12 col-sm-12">
                      @livewire('form.comuns.contact-ende-redes')
                  </div>--}}
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

        /* window.addEventListener('init-Component', event => {
             alert('Ola como estas');
         })*/
    </script>
@endpush
