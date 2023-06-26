<div class="modal fade" id="openSeccaoApresentacao" tabindex="-1" role="dialog"
     data-backdrop="static"
     aria-labelledby="openSeccaoApresentacao" aria-hidden="true" wire:ignore.self>

    <div class="modal-dialog modal-xl modal-dialog-centered  "
         role="document">

        <div class="modal-content p-10">
            <h1>Novo Conteudo</h1>
            <div class="separator separator-dashed mb-0 p-0"></div>
            <br>
            <br>
            <div class="form-group p-2">
                <div data-repeater-list="kt_docs_repeater_basic">
                    <div data-repeater-item>
                        <div class="form-group row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label required">Titulo</label>
                                <input type="text" class="form-control form-control-sm mb-2 mb-md-0"
                                       wire:model="data.title"
                                       placeholder="introduza o titilo da secção de apresentação"/>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label required">Conteudo</label>
                                <textarea type="text" class="form-control form-control-sm mb-2 mb-md-0"
                                          wire:model="data.context"
                                          placeholder="introduza o titilo da secção de apresentação"></textarea>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="">

                <button type="button"
                        wire:click.prevent="saveThen"
                        class="btn btn-sm btn-light btn-active-light-primary pt-1 pb-1 pl-0 pr-3 text-left">
                    Guardar
                    <span class="svg-icon svg-icon-3 m-0 toggle-off">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1"
                                      transform="rotate(-90 11 18)" fill="black"></rect>
                                <rect x="6" y="11" width="12" height="2" rx="1"
                                      fill="black"></rect>
                            </svg>
                        </span>

                </button>
                &nbsp;
                <button type="button" data-bs-dismiss="modal" aria-label="Close"
                        class="btn btn-sm btn-light btn-active-light-danger pt-1 pb-1 pl-0 pr-3 text-left">
                    fachar
                </button>

            </div>
            <br>
            <br>

            <div class="table-responsive">
                <table class="table table-striped gy-2 gs-2">
                    <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th style="max-width: 80px!important;width: 80px!important;">Ordem</th>
                        <th style="">Titulo</th>
                        <th style="max-width: 100px!important;width: 100px!important;">Acção</th>
                    </tr>
                    </thead>
                    <tbody {{--wire:sortable="updateTaskOrder"--}}>
                    @foreach($schedulessection as $item)
                        <tr wire:key="item-{{ $item->id }}" wire:sortable.item="{{ $item->id }}">
                            <td class="pl-4 cursor-move text-center"
                                wire:sortable.handle>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $item->title }}</td>


                            <td class="w-80px">
                                <button type="button" wire:click.prevent="deleteElement({{ $item }})"
                                        class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px float-right">
                                    <span class="svg-icon svg-icon-3 m-0 toggle-off">
                                       <i class="fa fa-trash"></i>
                                    </span>
                                </button>
                                &nbsp;
                                <button type="button" wire:click.prevent="editingInfor({{ $item }})"
                                        class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px float-right">
                                    <span class="svg-icon svg-icon-3 m-0 toggle-off">
                                       <i class="fa fa-edit"></i>
                                    </span>
                                </button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
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


        window.addEventListener('open-modal-apresentacao', evt => {
            $('#openSeccaoApresentacao').modal('show');
        })
        window.addEventListener('close-modal-event', evt => {
            $('#openSeccaoApresentacao').modal('hide');
            toastr.success(evt.detail.message);
        })

        window.addEventListener('message-success', evt => {
            toastr.success(evt.detail.message);
        })


        window.addEventListener('send-success', event => {


            toastr.success(event.detail.message);
        })

    </script>
@endpush