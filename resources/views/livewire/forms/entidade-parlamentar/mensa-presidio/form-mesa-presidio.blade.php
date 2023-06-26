<div>
    <form>
        <div class="card-body">

            <div class="col-12 col-sm-7">
                <div class="form-group mb-3">
                    <select class="form-select" id="deputadoSelector"
                            wire:model.defer="data.codFuncionario"
                            data-allow-clear="true"
                            data-placeholder="Selecione aqui o deputado da mesa do presidio">
                        <option></option>
                        @foreach($funcionarios as $e)
                            <option value="{{ $e['Codigo'] }}">{{ $e['Nome']  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-10 mb-lg-18">

            @include('livewire.forms.entidade-parlamentar.mensa-presidio.components.upload-photo')

            @include('livewire.forms.entidade-parlamentar.mensa-presidio.components.info-deputy')

            </div>

            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group mb-3">
                        <div class="form-group mb-3">
                            <label class="required">Seleciona a seção de apresentação</label>
                            <div class="input-group input-group-sm flex-nowrap">
                                <button class="input-group-text h-35px btn-success" wire:click.prevent="showModal">
                                    Nova
                                </button>
                                <div class="overflow-hidden flex-grow-1 mb-2">
                                    <select class="form-select form-select-sm selector rounded-start-0"
                                            wire:model.defer="data.scheduleSection_id" data-allow-clear="true"
                                            id="scheduleSection"
                                            data-placeholder="Selecione a seção da mesa presidio">
                                        <option></option>
                                        @foreach($scheduleSections as $sc)
                                            <option value="{{ $sc['id'] }}">{{ $sc['title']  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group mb-3">
                        <label class="required">{{ $entidadeParlamentar['statuSelector'] }}</label>
                        <div class="input-group input-group-sm flex-nowrap">

                            <input type="number"
                                   class="form-control input-group-text form-control-sm input-group-text h-35px text-black"
                                   style="max-width: 100px"
                                   placeholder="Ordem" wire:model.lazy="data.ordem">

                            <div class="overflow-hidden flex-grow-1 mb-2">
                                <select class="form-select form-select-sm selector rounded-start-0"
                                        data-allow-clear="true" id="select_entidade"
                                        wire:model.defer="data.typeWebApp"
                                        data-placeholder="Selecciona o tipo de entidade parlamentar">
                                    <option></option>
                                    @foreach($socialFunctionality as $item)
                                        <option value="{{  $item->typeWebApp }}">{{ $item->longDescription }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="input-group-text h-35px text-black"
                                    wire:click.prevent="openFuncao">
                                Novo
                            </button>

                        </div>

                        <span class="form-text text-muted">é importante seleccionar a Cargo / Função Parlamentar</span>
                    </div>

                </div>

                <div class="col-12 col-sm-2">
                    <div class="form-group mb-3">
                        <div class="form-group mb-3">
                            <label class="required badge badge-light-info">Data do Emposamento</label>
                            <input type="text" class="form-control form-control-sm" id="data_elito"
                                   placeholder="{{ date('d-m-Y') }}" wire:model.lazy="data.dataEleito">
                        </div>
                    </div>
                </div>
                <div class="row col-12 col-sm-12">
                    <div class="col-12 col-sm-4">
                        <div class="form-group mb-3">
                            <label class="required">Tipo</label>
                            <div class="input-group input-group-sm flex-nowrap">
                                <span class="input-group-text h-35px text-black">
                                   <i class="{{ $icon }}"></i>
                                </span>
                                <div class="overflow-hidden flex-grow-1 mb-2">
                                    <select
                                        class="form-select form-select-sm selector rounded-start-0 @error('icon') is-invalid @enderror"
                                        data-elements2="select2"
                                        id="selectIconSub" wire:model.defer="socialite.icon"
                                        data-placeholder="Seleccione o icone">
                                        <option></option>
                                        <option value="fab fa-facebook">Facebook</option>
                                        <option value="fab fa-twitter">Twitter</option>
                                        <option value="fab fa-linkedin">Linkedin</option>
                                        <option value="fab fa-youtube">Youtube</option>
                                    </select>
                                </div>


                            </div>
                            @error('icon')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-12 col-sm-8">
                        <div class="form-group mb-3">
                            <label class="required ">Link</label>
                            <div class="input-group input-group-sm flex-nowrap">
                                <input type="text"
                                       class="form-control form-control-sm  @error('url') is-invalid  @enderror "
                                       wire:model.defer="socialite.url"
                                       placeholder="inseri aqui o linke do deputado."/>
                                <button class="input-group-text h-35px text-black"
                                        wire:click.prevent="addSocialite">
                                    Adicionar
                                </button>
                            </div>
                            @error('url')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    @foreach($socialites as $sociale)
                        <span>
                            <i class="{{ $sociale['icon'] }} fa-4x text-primary float-left"></i>
                             <button class="badge badge-circle badge-danger"
                                     wire:click.prevent="eliminarSocialite('{{ $sociale['icon'] }}')"
                                     style="position: relative;margin-bottom: -10px; margin-left: -20px; border: none">
                                <i class="fa fa-trash text-white"></i>
                            </button>
                        </span>
                        &nbsp;
                        &nbsp;

                    @endforeach
                </div>
                @include('livewire.forms.entidade-parlamentar.mensa-presidio.components.laraberg-area-texto')

                <div class="col-12 mt-2">
                    <div class="input-group text-right justify-content-end">
                        <button type="button" class="btn btn-light-primary mr-2 btn-sm "
                                wire:click.prevent="saveEntityParliamentary">
                            Guardar o informação
                        </button>
                    </div>
                </div>
                <div class="separator separator-dashed border-primary my-5"></div>
                @livewire('forms.entidade-parlamentar.mensa-presidio.lista-buttom-tabs')
            </div>
        </div>

    </form>

    @livewire('forms.entidade-parlamentar.mensa-presidio.seccao-apresentacao')

    @livewire('forms.entidade-parlamentar.mensa-presidio.funcao-apresentacao')

    @livewire('forms.entidade-parlamentar.mensa-presidio.modal-buttom-tabs')

</div>
@include('livewire.forms.entidade-parlamentar.mensa-presidio.components.script-mesa')
