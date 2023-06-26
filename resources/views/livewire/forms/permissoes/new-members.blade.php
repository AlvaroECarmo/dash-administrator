<div class="modal fade" id="formNewMembers"
     {{-- tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"--}}
     {{--aria-hidden="true"--}} data-backdrop="static" wire:ignore.self>
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        @if($loader)
            <div class="overlay-wrapper">
                <div class="overlay bg-white"><i class="fas fa-2x fa-sync-alt fa-spin mr-3"></i>
                    <div class="text-bold pt-2">Aguarde...</div>
                </div>
            </div>
        @endif
        <div class="modal-content p-0">
            {{--<form wire:submit.prevent="novoMembro">--}}
            {{-- @csrf--}}
            <div class="card card-lightblue mb-0">
                <div class="card-header">
                    <h3 class="card-title">Novo membro</h3>
                </div>
                <div class="card-body ">
                    <div class="mb-3">

                        @if(!$editingFlag)
                            @livewire('forms.comuns.auto-complite-ldap', ['labelName'=>'Funcionário', 'mb3'=>true])
                        @endif


                        @if (session()->has('errorEmpty'))
                            <div class="text-danger txt-sm"> {{ session('errorEmpty') }}</div>
                        @endif
                    </div>
                    @if($editingFlag)
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 160px">Funcionário</span>
                            </div>
                            <input type="text" class="form-control" placeholder="preenchimento automatico" disabled
                                   wire:model.defer="user.name">
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 160px">Departamento</span>
                        </div>
                        <input type="text" class="form-control" placeholder="preechimento automatico" disabled
                               wire:model.defer="user.department">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width: 160px">Area de acesso</span>
                        </div>
                        <input type="text" class="form-control" placeholder="preenchimento automatico" disabled
                               wire:model.defer="group.name">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend ">
                                  <span class="border p-2 "
                                        style="width: 160px; border-radius: 4px 0 0 4px; background: rgba(206,212,218,0.53)">Observações</span>
                        </div>
                        <textarea type="text" class="form-control @error('observacoes') is-invalid @enderror"
                                  maxlength="450" minlength="20"
                                  wire:model.defer="observation"
                                  placeholder="Observações da justificação de faltas selecionadas"
                                  rows="4"></textarea>
                        @error('observacoes')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox2"
                               style="cursor: pointer" wire:model.defer="isAdmin">
                        <label for="customCheckbox2" class="custom-control-label font-weight-normal"
                               style="cursor: pointer">
                            Atribuir permissão administrativa
                        </label>
                    </div>
                </div>


            </div>
            <div class="modal-footer card-footer mt-0 flex float-lg-right justify-content-end bg-transparent">
                <button class="btn btn-danger mr-1 text-uppercase " data-dismiss="modal" wire:ignore.self
                    {{--wire:click.prevent="removeAllEEvaluetionAnswer"--}}>
                    Cancelar &nbsp; <i class="fa fa-times mr-1"></i>
                </button>
                <button class="btn btn-primary mr-1 text-uppercase " type="button" wire:loading.remove
                        wire:click.prevent="novoMembro">
                    Adicionar &nbsp; <i class="fa fa-paper-plane mr-1"></i>
                </button>
                <button class="btn btn-warning " type="button" disabled wire:loading
                        wire:click.prevent="novoMembro">
                    Aguarde ... &nbsp;
                    <span class="spinner-border spinner-border-sm align-items-center" role="status"
                          aria-hidden="true">
                        </span>
                </button>
            </div>
            {{--   </form>--}}
        </div>
    </div>
</div>


@push('scripts')
    <script>
        // select2-container select2-container--default select2-container--open

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


        window.addEventListener('show-form', event => {
            $('#formNewMembers').modal('show');
        });

        window.addEventListener('show-form-in', event => {
            $('#formNewMembers').modal('show');
        });


    </script>
@endpush
