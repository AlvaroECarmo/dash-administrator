<div class="modal fade" id="bottonApresentacao" tabindex="-1" role="dialog"
     data-backdrop="static"
     aria-labelledby="openFuncaoInformation" aria-hidden="true" wire:ignore.self>

    <div class="modal-dialog modal-xl modal-dialog-centered  "
         role="document">

        <div class="modal-content p-10">
            <h1>Links de apresentação</h1>
            <div class="separator separator-dashed mb-0 p-0"></div>
            <br>
            <br>
            <div class="form-group p-2">
                <div data-repeater-list="kt_docs_repeater_basic">
                    <div data-repeater-item>
                        <div class="form-group row">

                            <div class="col-md-7 mb-4">
                                <label class="form-label required">Apresentação</label>
                                <div class="overflow-hidden flex-grow-1 mb-2">

                                    <select class="form-select form-select-sm rounded-start-0"
                                            wire:model="tabbtnslist.schedulesSection_id" data-allow-clear="true"
                                            id="informacaoApresentacao"
                                            data-placeholder="Selecione a seção da mesa presidio">
                                        <option></option>
                                        @foreach($scheduleSections as $p)
                                            <option value="{{ $p['id'] }}">{{ $p['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="row">

                                    <div class="col-md-4 mb-4" wire:ignore>
                                        <label class="form-label required">Posição</label>
                                        <select class="form-select form-select-sm rounded-start-0"
                                                wire:model="tabbtnslist.dataTab" data-allow-clear="true"
                                                id="posicaoApresentacao"
                                                data-placeholder="Selecione a posição de apresentação">
                                            <option></option>
                                            <option value="#tab-1">Ordenar na primeira tabela</option>
                                            <option value="#tab-2">Ordenar na segunda tabela</option>
                                            <option value="#tab-3">Ordenar na terceira tabela</option>


                                        </select>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label class="form-label required">Título</label>
                                        <input type="text" class="form-control form-control-sm mb-2 mb-md-0"
                                               wire:model="tabbtnslist.context"
                                               placeholder="introduza o titilo da secção de apresentação"/>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="">

                <button type="button"
                        wire:click.prevent="saveBtnLists"
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
                        <th style="">Secção Apresentação</th>
                        <th style="max-width: 100px!important;width: 100px!important;">Acção</th>
                    </tr>
                    </thead>
                    <tbody {{--wire:sortable="updateTaskOrder"--}}>
                    @foreach($tabbtnslists as $add)
                        <tr wire:key="item-{{ $add->id }}" wire:sortable.item="{{ $add->id }}">
                            <td class="pl-4 cursor-move text-center"
                                wire:sortable.handle>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $add->context }}</td>
                            <td>{{ $add->schedulesSection->title }}</td>


                            <td class="w-80px">
                                <button type="button" wire:click.prevent="deleteElement({{ $add }})"
                                        class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px float-right">
                                        <span class="svg-icon svg-icon-3 m-0 toggle-off">
                                           <i class="fa fa-trash"></i>
                                        </span>
                                </button>
                                &nbsp;
                                <button type="button" wire:click.prevent="editingInfor({{ $add }})"
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
        selectInfoApresenta();
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                selectInfoApresenta();
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

                selectInfoApresenta();
            })
        });

        function selectInfoApresenta() {
            $('#informacaoApresentacao').select2().on('change', () => {
                @this.
                set('tabbtnslist.schedulesSection_id', $('#informacaoApresentacao').select2('val'))
            })
            $('#posicaoApresentacao').select2().on('change', () => {
                @this.
                set('tabbtnslist.dataTab', $('#posicaoApresentacao').select2('val'))
            })
        }

        window.addEventListener('open-modal-botton', evt => {
            $('#bottonApresentacao').modal('show');
        })

        window.addEventListener('close-modal-event', evt => {
            $('#openFuncaoInformation').modal('hide');
            toastr.success(evt.detail.message);
        })

        window.addEventListener('message-success-tabs', evt => {
            toastr.success(evt.detail.message);
        })

        window.addEventListener('send-success', event => {
            toastr.success(event.detail.message);
        })
    </script>
@endpush
