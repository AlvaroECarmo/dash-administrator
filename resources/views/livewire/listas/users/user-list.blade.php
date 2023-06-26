{{-- -------------------------------------------------------------- --}}
{{-- Componente : Lista de utilizadores e acções associadas         --}}
{{-- Versão 1.0                                                     --}}
{{--                                                                --}}
{{-- ACÇÕES:                                                        --}}
{{--    Inserção, Alteração e Remoção                               --}}
{{-- EVENTOS:                                                       --}}
{{--    novoUtilizador: Formulário de criação de novo utilizador    --}}
{{--    criaUtilizador: Gravação do novo utilizador                 --}}
{{-- PROPRIEDADES:                                                  --}}
{{--    estado.name: Nome do utilizador                             --}}
{{--    estado.email: Email do utilizador                           --}}
{{--    estado.password: Palavra passe do utilizador                --}}
{{--    estado.password_confirmation: Confirmação da palavra passe  --}}
{{--    estado.perfil: Perfil do utilizador                         --}}
{{-- PARAMETROS:                                                    --}}
{{--    $utilizadores: Lista paginada de utilizadores               --}}
{{--    $roles: Lista de perfis da BD                               --}}
{{-- OUTRAS PROPRIEDADES:                                           --}}
{{--    $editMode: Indica se o formulário modal é de edição         --}}
{{--                                                                --}}
{{-- -------------------------------------------------------------- --}}
<div>
    @if (session()->has('pesquisaError'))
        <div class="alert alert-info alert-dismissible mb-1">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-info"></i>
            {{ session('pesquisaError') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-user"></i> Utilizadores</h3>
            <div class="d-flex align-items-end float-right">

                <input type="text" class="input-sm" style="width:300px;" wire:model.debounce.500ms="termoPesquisaForm">
                <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-sm mr-1 disabled"><i
                                class="fa fa-search"></i></button>
                  </span>

                @if($pdfGerado)
                    <a class="btn btn-primary btn-sm mr-1" href="{{$pdfGerado}}" target="_blank">
                        <i class="fa fa-download mr-1"></i>Relatorio de Utilizadores.pdf
                    </a>
                @endif
                <button class="btn btn-warning mr-1 btn-sm" wire:click.prevent="listagemUtilizadores">
                    <i class="fa fa-file-pdf mr-1"></i>Listagem
                </button>
                @ifNaoUsa_ldap
                <button class="btn btn-success btn-sm" wire:click.prevent="novoUtilizador" wire:loading.class="disabled"
                        wire:target="listagemUtilizadores">
                    <i class="fa fa-plus-circle mr-1"></i>Novo utilizador
                </button>
                @endif
            </div>
        </div>

        @if(session()->has('error'))
            <div class="alert bg-gradient-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span>{{ session()->get('error') }}</span>
            </div>
        @endif

        <div class="card-body p-0">
            <table class="table table-striped table-sm table-hover" disabled="disabled">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 35%">Nome</th>
                    <th style="width: 35%">@ifUsa_ldap Login @else Email @endif</th>
                    <th style="width: 10%">Perfil</th>
                    @ifNaoUsa_ldap
                    <th style="width: 15%" class="text-center">Acções</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($utilizadores as $utilizador)
                    <tr>
                        <td style="width: 5%">{{$loop->iteration}}</td>
                        <td style="width: 35%">
                            <img src="{{$utilizador->getAvatarUrlAttribute()}}" style="width:25px;height: 25px;"
                                 class="rounded-circle elevation-2" alt="User Image">
                            {{$utilizador->name}}

                        </td>
                        <td style="width: 35%">{{$utilizador->email}}</td>
                        <td style="width: 10%">
                            <span class="badge bg-warning">Administrador</span>
                        </td>
                        @ifNaoUsa_ldap
                        <td class="text-center" style="width: 15%">
                            <div class="btn-group">
                            <span class="mr-1"><a href="" wire:click.prevent="editaUtilizador({{$utilizador}})"
                                                  wire:loading.class="disabled" wire:target="listagemUtilizadores"
                                                  class="btn btn-rounded btn-warning btn-sm" data-toggle="tooltip"
                                                  title="Editar o registo">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a></span>
                                <span><a href="" wire:click.prevent="confirmaRemocaoUtilizador({{$utilizador->id}})"
                                         wire:loading.class="disabled" wire:target="listagemUtilizadores"
                                         class="btn btn-rounded btn-danger btn-sm" data-toggle="tooltip"
                                         title="Remover o registo">
                                        <i class="fa fa-trash"></i>
                                    </a></span>
                            </div>

                        </td>
                        @else
                            @if(Auth::user()->canImpersonate())
                                <td class="text-center" style="width: 15%">
                                    <div class="btn-group">
                                <span class="mr-1"><a href="" wire:click.prevent="impersonate({{$utilizador}})"
                                                      class="btn btn-rounded btn-primary btn-sm" data-toggle="tooltip"
                                                      title="Impersonate">
                                        <i class="fa fa-user-lock"></i>
                                    </a></span>
                                    </div>
                                </td>
                            @endif
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-1 mr-1 d-flex justify-content-end">
                {{$utilizadores->links()}}
            </div>
        </div>
        {{-- -------------------------------------------------------- --}}
        {{-- FORMULÁRIO MODAL DE INSERÇÃO E ALTERAÇÃO DE UTILIZADORES --}}
        {{-- -------------------------------------------------------- --}}
        <div class="modal fade" id="formUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="{{$showEditModal ? 'atualizaUtilizador' : 'criaUtilizador'}}"
                          autocomplete="off">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-user-circle mr-1"></i>
                                    @if($showEditModal)
                                        <span>Editar utilizador</span>
                                    @else
                                        <span>Novo utilizador</span>
                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="form-group">
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user mr-1"></i> Nome</span>
                                        </div>
                                        <input type="text" wire:model.defer="estado.name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Nome" id="Nome">
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-envelope mr-1"></i> Email</span>
                                        </div>
                                        <input type="text" wire:model.defer="estado.email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Email" id="Email">
                                        @error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock mr-1"></i> Palavra passe</span>
                                        </div>
                                        <input type="password" autocomplete="off" wire:model.defer="estado.password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Palavra passe" id="Password">
                                        @error('password')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock mr-1"></i> Confirmação</span>
                                        </div>
                                        <input type="password" autocomplete="off"
                                               wire:model.defer="estado.password_confirmation" class="form-control"
                                               placeholder="Confirmação da palavra passe">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend" style="flex: 0 0 20%">
                                                    <span class="input-group-text" style="width: 100%">
                                                        <i class="fas fa-users mr-1"></i> Perfil
                                                    </span>
                                        </div>
                                        <select class="form-control" id="listaPerfil" style="width: 80%"
                                                wire:model.defer="estado.perfil">
                                            <option value="">Selecione o perfil</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('perfil')
                                        <input type="text" hidden class="@error('perfil') is-invalid @enderror">
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="input-group mb3">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" wire:model="photo" name="file"
                                                       data-browse="Pesquisar" class="custom-file-input"
                                                       id="chooseFile">
                                                <label id="chooseFileText" class="custom-file-label"
                                                       data-browse="Pesquisar" for="chooseFile">
                                                    @if($photo)
                                                        {{$photo->getClientOriginalName()}}
                                                    @else
                                                        Selecione a imagem de perfil
                                                    @endif
                                                </label>
                                            </div>
                                            <input type="text" hidden class="@error('avatar') is-invalid @enderror">
                                            @error('avatar')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer form-group">
                                <div class="float-right">
                                    <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal"><i
                                            class="fa fa-times-circle mr-1"></i>Cancelar
                                    </button>
                                    <button type="submit" wire:loading.remove wire:target="criaUtilizador"
                                            class="btn btn-primary">
                                        <i class="fa fa-check-circle mr-1"></i>
                                        @if($showEditModal)
                                            <span>Atualizar</span>
                                        @else
                                            <span>Gravar</span>
                                        @endif
                                    </button>
                                    <button class="btn btn-warning" type="button" disabled wire:loading
                                            wire:target="criaUtilizador">
                                        <span class="spinner-border spinner-border-sm align-items-center" role="status"
                                              aria-hidden="true"></span>
                                        Aguarde
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- -------------------------------------------------------------- --}}
        {{-- FIM : FORMULÁRIO MODAL DE INSERÇÃO E ALTERAÇÃO DE UTILIZADORES --}}
        {{-- -------------------------------------------------------------- --}}

        {{-- -------------------------------------------------------- --}}
        {{-- FORMULÁRIO MODAL DE CONFIRMAÇÃO DE REMOÇÃO DE UTILIZADOR --}}
        {{-- -------------------------------------------------------- --}}
        <div class="modal fade" id="formConfirmation" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="card card-red">
                        <div class="card-header card-red">
                            <h3 class="card-title"><i class="fa fa-user-circle mr-1"></i>
                                Remoção de utilizador
                            </h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <h4>Confirma a remoção do utilizador ?</h4>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal"><i
                                        class="fa fa-times-circle mr-1"></i>Cancelar
                                </button>
                                <button type="button" class="btn btn-danger"
                                        wire:click.prevent="removeUtilizador({{$userIdBeingRemoved}})">
                                    <i class="fa fa-times-circle mr-1"></i> Remover
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- -------------------------------------------------------------- --}}
        {{-- FIM : FORMULÁRIO MODAL DE CONFIRMAÇÃO DE REMOÇÃO DE UTILIZADOR --}}
        {{-- -------------------------------------------------------------- --}}
    </div>
</div>

{{-- SCRIPTS ESPECIFICOS PARA UTILIZAÇÃO DO COMPONENTE SELECT2 --}}

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                inicializaSelect2();
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
                inicializaSelect2();
            })
        });

        // Inicialização do componente Select2
        function inicializaSelect2() {
            $('#listaPerfil').select2({
                language: "pt",
                dropdownParent: $('#formUser .modal-content')
            });

            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });

            $('#listaPerfil').on('change', function (e) {
                var data = $('#listaPerfil').select2("val");
                @this.
                set('estado.perfil', data);
            });
        }
    </script>
@endpush
{{-- FIM : SCRIPTS ESPECIFICOS PARA UTILIZAÇÃO DO COMPONENTE SELECT2 --}}
