<div class="modal fade" id="outOffice"
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
                    <h3 class="card-title">Ausentar o director (Out / in Office)</h3>
                </div>
                <div class="card-body ">

                    @if((Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isManager()))

                        @if (Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                            <div class="mb-3">
                                @livewire('forms.comuns.auto-complite-ldap', ['labelName'=>'Director', 'mb3'=>'true'])

                                <input type="hidden" class="@error('nomeFuncionario') is-invalid @enderror">
                                @error('nomeFuncionario')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror

                                <input type="hidden" class="@error('managerName') is-invalid @enderror">
                                @error('managerName')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror

                            </div>
                        @else
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 160px">Director</span>
                                </div>
                                <input type="text" class="form-control" placeholder="preenchimento automatico"
                                       disabled
                                       wire:model.defer="outInOffice.managerName">
                            </div>
                        @endif

                    @endif

                    <div class="{{ $outChange }}">
                        <div class="mb-3">
                            @livewire('forms.comuns.auto-complite-ldap', ['labelName'=>'Funcionário', 'mb3'=>'true'])
                            <input type="hidden" class="@error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 160px">Data inicial</span>
                            </div>
                            <input type="text" class="form-control datainical @error('outOffice') is-invalid @enderror"
                                   placeholder="Selecciona a data inicial " wire:model.defer="outInOffice.outOffice">
                            @error('outOffice')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 160px">Data final</span>
                            </div>
                            <input type="text" class="form-control datafinal @error('inOffice') is-invalid @enderror"
                                   placeholder="Selecciona a data final" wire:model.defer="outInOffice.inOffice"
                                   id="dateInOffice">
                            @error('inOffice')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend ">
                                  <span class="border p-2 "
                                        style="width: 160px; border-radius: 4px 0 0 4px; background: rgba(206,212,218,0.53)">Observações</span>
                            </div>
                            <textarea type="text" class="form-control "
                                      maxlength="450" minlength="20"
                                      wire:model.defer="outInOffice.observation"
                                      placeholder="É importante informar o motivo da ausencia ou presença no sistema"
                                      rows="4"></textarea>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Selecciona o evento </label>
                        <div class="pl-3">
                            <div class="custom-control custom-radio mb-2" style="cursor: pointer">
                                <input class="custom-control-input custom-control-input-danger" type="radio"
                                       wire:change.prevent="eventChange(event.target.value, 'out')"
                                       @if($eventInOrOut['outOffice']) checked @endif
                                       id="customRadio1" name="customRadio">
                                <label for="customRadio1" class="custom-control-label " style="cursor: pointer">
                                    Out of the Office
                                    <span class="text-muted font-weight-normal">(Director ausente nas funções)</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio" style="cursor: pointer">
                                <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio"
                                       wire:change.prevent="eventChange(event.target.value, 'in')"
                                       @if($eventInOrOut['inOffice']) checked @endif>
                                <label for="customRadio2" class="custom-control-label" style="cursor: pointer">
                                    In the Office
                                    <span class="text-muted font-weight-normal">(Director presente nas funções)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal-footer card-footer mt-0 flex float-lg-right justify-content-end bg-transparent">
                <button class="btn btn-danger mr-1 " data-dismiss="modal" wire:ignore.self
                    {{--wire:click.prevent="removeAllEEvaluetionAnswer"--}}>
                    Cancelar &nbsp; <i class="fa fa-times mr-1"></i>
                </button>
                <button class="btn btn-primary mr-1 " type="button" wire:loading.remove
                        wire:click.prevent="saveOut">
                    Guardar &nbsp;
                </button>
                <button class="btn btn-warning " type="button" disabled wire:loading
                        wire:click.prevent="saveOut">
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
                init();
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
                init();
            })
        });

        window.addEventListener('show-form-in', event => {
            $('#outOffice').modal('show');
        });

        $('.datafinal , .datainical').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            language: "pt"
        });

        $('#dateInOffice').on('change', function () {
            // alert($(this).val());
        @this.set('outInOffice.inOffice', $(this).val());
        });

        $('.datainical').on('change', function () {
            // alert($(this).val());
        @this.set('outInOffice.outOffice', $(this).val());
        });

    </script>
@endpush
