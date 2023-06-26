<div class="{{$mb3?'':'mb-3'}}">
    <div class="input-group" wire:ignore>
        <div class="input-group-prepend">
            <span class="input-group-text" style="width: 160px">{{$labelName}}</span>
        </div>
        <input type="text" class="form-control" wire:ignore
              {{-- wire:change.prevent="changeKeyEvent"--}}
               wire:model.defer="selectedName"
               placeholder="Introduza o nome"
               wire:keyup="getUserAd(event.target.value)">
    </div>
    <div class="card" style="position: absolute; z-index: 1000;
         background-color: rgb(255,255,255); width: 96.5%; border-radius: 0 0 5px 5px">
        @foreach($users as $detecteds)
            @if ($detecteds != "")
                <div class="alert p-0 text-sm text-muted text-success mt-2 ml-3 mb-1 mr-3
                     border-bottom  alert-dismissible row"
                     style="cursor: pointer">
                    <input type="text" class="form-control form-control-sm col-10"
                           value="{{$detecteds}}"
                           style="border: none; background-color: transparent!important; cursor: pointer"
                           wire:click.prevent="nomeprocessado(event.target.value)">
                    <div class="col-2">
                        <a class="text-secondary btn-sm text-danger float-right"
                           data-toggle="tooltip"
                           data-dismiss="alert" aria-hidden="true"
                           style="cursor: pointer"
                           title="Eliminar o item">
                            <i class="far fa-trash-alt"></i> </a>
                    </div>
                </div>
            @endif

        @endforeach
        @if (!empty($users) && $user['name']!= null)
            <span class="text-primary ml-3 mb-2 pl-2">é importante seleccionar as sugestões
                <a class="text-secondary btn-sm text-danger float-right mr-4"
                   data-toggle="tooltip" wire:click.prevent="closeListing"
                   data-dismiss="alert" aria-hidden="true"
                   style="cursor: pointer" title="fechar as sugestões">
                        <i class="fas fa-times"></i>
                </a>
            </span>
        @endif
    </div>
    @if($selectedName != "" && $user['name'] == null)
        <div class="text-sm text-muted text-danger">
            <span class="text-danger">
                O funcionário não está registrado na AD, consulta o administrador
            </span>
        </div>
    @endif


</div>
