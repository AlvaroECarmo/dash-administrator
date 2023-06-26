<form>

    <div class="row">
        <div class="col-12 col-sm-5">
            <div class="form-group mb-3">
                <label class="required">Titulo</label>
                <input type="text"
                       class="form-control form-control-sm @error('titleContext') is-invalid @enderror"
                       wire:model.defer="conteudoData.titleContext"
                       placeholder="Introduza aqui a zona"/>
                @error('titleContext')
                <span class="form-text text-danger">{{ $message }}</span>
                @enderror

            </div>
        </div>

        <div class="form-group  mt-2 mb-3">
            <div class="" wire:ignore>
                <label class="required badge badge-light-info">Conteudo Informativo</label>
                <textarea class="form-control" hidden id="[id_here]" name="[name_here]"
                          wire:ignore.self rows="5"></textarea>
            </div>
            @error('titleContext')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-12 col-sm-12 ">
            <div class="form-group mb-3 mt-2 row">
                <div class="col-sm-12 my-10">
                    <label class="badge badge-light-info cursor-pointer"
                           wire:click.prevent="openOrCloseAuthForm">
                        {!! $contextInfoAuthForm !!} &nbsp;
                    </label>
                    <label class="required badge badge-light-primary {{ $openOrCloseAuthForm }}">Informação
                        do Autor</label>
                    <div class="separator separator-dotted border-secondary "></div>
                </div>
                <div class="{{ $openOrCloseAuthForm }}">
                    <div class="col-12 col-sm-5">
                        <div class="form-group mb-3">
                            <label class="required">Nome</label>
                            <input type="text"
                                   class="form-control form-control-sm @error('auth') is-invalid @enderror "
                                   wire:model.defer="dataAuth.auth"
                                   placeholder="Introduza o nome do autor"/>
                            @error('auth')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group mb-3">
                            <label class="required badge badge-light-info">Conteudo</label>
                            <textarea wire:ignore.self
                                      class="form-control form-control-sm @error('context') is-invalid  @enderror "
                                      name="kt_docs_ckeditor_classic "
                                      wire:model.defer="dataAuth.context"
                                      rows="3"></textarea>
                            @error('context')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="input-group text-right justify-content-end">
                <button type="button" class="btn btn-light-primary btn-sm mr-2"
                        wire:click.prevent="saveInfoBody">
                    Guardar a informação
                </button>
            </div>
        </div>
    </div>
</form>
