<div class=" p-0">
    <form action="">
        @csrf
        <div class="p-0 mb-0">
            <div class="card-header pl-0 ml-0">
                <h3 class="card-title">Activar uma area na aplicação</h3>
            </div>
            <div class="card-body pl-0 ml-0">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 160px">Area de trabalho</span>
                    </div>
                    <select class="form-control col "
                            style="min-width: 410px; height: 40px" wire:ignore
                            wire:change.prevent="changeGroup(event.target.value)"
                            wire:model.defer="group.web">
                        <option value="">Seleccioa a área</option>
                        @foreach($Groups as $group)
                            <option value="{{$group['web']}}">{{$group['name']}}</option>
                        @endforeach

                    </select>

                </div>

                <div class="input-group mb-3">

                    <input type="hidden" class="form-control @error('web') is-invalid @enderror">
                    @error('web')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>


                <div class="input-group mb-3">
                    <div class="input-group-prepend ">
                                  <span class="border p-2 "
                                        style="width: 160px; border-radius: 4px 0 0 4px; background: rgba(206,212,218,0.53)">Comentário</span>
                    </div>
                    <textarea type="text" class="form-control"
                              minlength="20"
                              wire:model.defer="group.observation"
                              placeholder="Observações da justificação de faltas selecionadas"
                              rows="8"></textarea>

                </div>

                {{--  <div class="input-group mb-0"
                       wire:ignore>
                      <div class="input-group-prepend">
                          <span class="input-group-text" style="width: 160px">Motivo da falta</span>
                      </div>
                      <select class="form-control "
                              id="motivodaFalta"
                              style="width: 85.5%;" wire:ignore wire:model.defer="motivoCodigo">
                          <option value="">Selecione o motivo</option>
                          @forelse($asCodigos as $asCodigo)
                              <option value="{{ $asCodigo }}">{{ $asCodigo->Descricao }}</option>
                          @empty
                              <option>Nem um motivo de falta encontrado...</option>
                          @endforelse

                      </select>

                  </div>
                  <div class="input-group mb-3">
                      @error('codigoJustificacao')
                      <div class="text-sm text-muted text-red ">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend ">
                          <span class="border p-2 "
                                style="width: 160px; border-radius: 4px 0 0 4px; background: rgba(206,212,218,0.53)">Observações</span>
                      </div>
                      <textarea type="text" class="form-control @error('observacoes') is-invalid @enderror"
                                maxlength="450" minlength="20"
                                wire:model.defer="justificacaoFalta.observacoes"
                                placeholder="Observações da justificação de faltas selecionadas"
                                rows="4"></textarea>
                      @error('observacoes')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                  </div>--}}

            </div>


        </div>
        <div class="card-footer mt-0 flex float-lg-right justify-content-end bg-transparent">
            <button class="btn btn-primary mr-1 text-uppercase " type="button" wire:loading.remove
                    wire:click.prevent="saveGroup">
                Guardar &nbsp;
            </button>
            <button class="btn btn-warning " type="button" disabled wire:loading
                    wire:click.prevent="saveGroup">
                Aguarde ... &nbsp;
                <span class="spinner-border spinner-border-sm align-items-center" role="status"
                      aria-hidden="true">
                        </span>
            </button>
        </div>
    </form>
</div>
