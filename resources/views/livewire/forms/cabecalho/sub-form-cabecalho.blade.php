<div class="modal fade" id="socializeForme" tabindex="-1" role="dialog"
     data-backdrop="static"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>

    <div class="modal-dialog modal-xl modal-dialog-centered  "
         role="document">

        <div class="modal-content p-10">
            <h1>Nova informação</h1>
            <div class="separator separator-dashed mb-0 p-0"></div>
            <br>
            <br>
            <div class="form-group p-2">
                <div data-repeater-list="kt_docs_repeater_basic">
                    <div data-repeater-item>
                        <div class="form-group row">

                            <div class="col-md-3" wire:ignore>
                                <label class="form-label">Tipo<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-select-sm selector mb-2 mb-md-0 "
                                        data-element="select2"
                                        wire:model="data.tipo" id="tipos" data-hide-search="false"
                                        data-placeholder="Selecciona o tipo de conteudo">
                                    <option></option>
                                    <option value="socialitesList">Rede Social</option>
                                    <option value="inforList">link informação</option>
                                    <option value="listLange">Lista de Linguas</option>
                                    <option value="linksBox">Box Lista</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label required">{{ $nameTitle }}</label>
                                <input type="text" class="form-control form-control-sm mb-2 mb-md-0"
                                       wire:model="data.context"
                                       placeholder="introduza o titilo da rede social"/>
                            </div>


                            @if($tipoSelect == "socialitesList")
                                <div class="cal-sm-12 row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">url</label>
                                        <input type="email" class="form-control form-control-sm mb-2 mb-md-0"
                                               wire:model="data.url"
                                               placeholder="Introduza a url do conteudo"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">icon<span
                                                class="text-danger">*</span></label>

                                        <div class="input-group input-group-sm flex-nowrap">
                                <span class="input-group-text h-35px text-black">
                                   <i class="{{ $data['icon'] }}"></i>
                                </span>
                                            <div class="overflow-hidden flex-grow-1 mb-2" wire:ignore>
                                                <select class="form-select form-select-sm selector rounded-start-0"
                                                        data-elements2="select2"
                                                        id="selectIconSub" wire:model="data.icon"
                                                        data-placeholder="Seleccione o icone">
                                                    <option></option>
                                                    <option value="fab fa-facebook">Facebook</option>
                                                    <option value="fab fa-twitter">Twitter</option>
                                                    <option value="fab fa-linkedin">Linkedin</option>
                                                    <option value="fab fa-youtube">Youtube</option>
                                                    <option value="fab fa-google">fab fa-google</option>
                                                    <option value="fab fa-google-plus">fab fa-google-plus</option>
                                                    <option value="fas fa-phone">fas fa-phone</option>
                                                    <option value="flaticon-sunny-day-or-sun-weather">Tempo actual
                                                    </option>
                                                    <option value="fa fa-envelope">Envelope</option>
                                                    <option value="fa fa-user">Utilizador</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($tipoSelect == "linksBox")
                                <div class="cal-sm-12 row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label">url</label>
                                        <input type="email" class="form-control form-control-sm mb-2 mb-md-0"
                                               wire:model="data.url"
                                               placeholder="Introduza a url do conteudo"/>
                                    </div>
                                </div>

                            @elseif($tipoSelect == "inforList")
                                <div class="cal-sm-12 row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label">url</label>
                                        <input type="email" class="form-control form-control-sm mb-2 mb-md-0"
                                               wire:model="data.url"
                                               placeholder="Introduza a url do conteudo"/>
                                    </div>
                                </div>


                            @elseif($tipoSelect == "listLange")
                                <div class="cal-sm-12 row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Pais / região</label>
                                        <input type="email" class="form-control form-control-sm mb-2 mb-md-0"
                                               wire:model="data.designation"
                                               placeholder="Introduza a url do conteudo"/>
                                    </div>

                                </div>


                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                @if($tipoSelect)
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
                @endif
            </div>
            <br>
            <br>

            <div class="table-responsive">
                <table class="table table-striped gy-2 gs-2">
                    <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th style="max-width: 80px!important;width: 80px!important;">Ordem</th>
                        <th style="max-width: 160px!important;width: 160px!important;">Tipo</th>
                        <th style="max-width: 180px!important;width: 180px!important;">Titulo</th>
                        <th>Contexto</th>

                        <th>Acção</th>
                    </tr>
                    </thead>
                    <tbody {{--wire:sortable="updateTaskOrder"--}}>
                    @foreach($headercontent as $item)
                        <tr {{--wire:key="item-{{ $item->id }}"  wire:sortable.item="{{ $item->id }}"--}}>
                            <td class="pl-4 cursor-move text-center"
                                wire:sortable.handle>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $item->tipeContext() }}</td>
                            <td>{{ $item->context }}</td>
                            <td>
                                @if($item->url != "#")
                                    {{ $item->designation??$item->url }}
                                @else
                                    {{ $item->designation }}
                                @endif
                            </td>

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

        initSelector();
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initSelector();
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
                initSelector();
            })
        });


        function initSelector() {


            $(this).find('[data-elements2="select2"]').select2();

            $('#tipos').select2().on('change', function () {
                let data = $('#tipos').val()
                @this.set('data.tipo', data)
            });


            $('#selectIconSub').select2().on('change', function () {
                let data = $('#selectIconSub').val()
                @this.set('data.icon', data)
            });


        }

        window.addEventListener('send-success', event => {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toastr-bottom-center",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "600",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.success(event.detail.message);
        })

    </script>
@endpush
