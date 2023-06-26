<div>
    <div class="col-xl-12 mb-5 mb-xl-10">

        <div class="card card-flush h-xl-100">

            <div class="card-header pt-7">

                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder text-dark">Grupos de trabalho</span>
                    <span class="text-gray-400 mt-1 fw-bold fs-6">{{ auth()->user()->name }}</span>
                </h3>

                <div class="card-toolbar">

                    <div class="d-flex flex-stack flex-wrap gap-4">

                        <div class="d-flex align-items-center fw-bolder">
                            <!--begin::Label-->
                            <div class="text-muted fs-7 me-2">Estado</div>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select wire:model="activactInfo" id="SelectorEstado"
                                    class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto"
                                    data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px"
                                    data-placeholder="Select an option" data-kt-table-widget-4="filter_status">
                                <option value="Show All" selected="selected">Todos os Estaos</option>
                                <option value="Pendentes">Pendentes</option>
                                <option value="Activo">Activo</option>
                            </select>
                            <!--end::Select-->
                        </div>


                        <div class="position-relative my-1">

                            <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223"
                                          width="8.15546" height="2" rx="1"
                                          transform="rotate(45 17.0365 15.1223)"
                                          fill="black"/>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-table-widget-4="search" wire:model="seachWord"
                                   class="form-control w-100 w-sm-500px fs-7 ps-12"
                                   placeholder="Search"/>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Filters-->
                </div>

            </div>

            <div class="card-body">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-3 text-left">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th style="max-width: 80px!important;">ID</th>
                        <th class="min-w-100px">Nome do Grupo</th>
                        <th class="min-w-125px">Estado</th>
                        <th class=" min-w-100px">Views</th>
                        <th class=""></th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bolder text-gray-600">
                    @foreach($listaGrupos as $item)
                        <tr>
                            <td style="max-width: 80px!important;">
                                <a href="#" class="text-dark text-hover-primary">{{ $item->id }}</a>
                            </td>
                            <td class="font-weight-light">{{ $item->name }}</td>
                            <td class="">
                                @if($item->status)
                                    <span class="badge  badge-light-info">Activo</span>
                                @else
                                    <span class="badge  badge-light-warning">Pendente</span>
                                @endif
                            </td>
                            <td class="">
                                @foreach($item->groupsHasViews as $views)
                                    @if(($views->id%2)== 0  )
                                        <span
                                            class="badge  badge-light-danger"> {{$views->name_views }}</span>
                                    @else
                                        <span
                                            class="badge  badge-light-info"> {{$views->name_views }}</span>
                                    @endif
                                @endforeach

                            </td>
                            <td>
                                <div class="symbol-group symbol-hover mb-1">
                                    <!--begin::Member-->
                                    @foreach(\App\Models\Parlamento\Group::activitiesUsers($item->id, 'Livewire.Forms.Permissoes.NewGroup') as $userActives)
                                        <div class="symbol symbol-circle symbol-25px">
                                            <img
                                                src="{{ auth()->user()->getAvatarN( $userActives['primavera_email']) }}"
                                                alt="">
                                        </div>
                                    @endforeach

                                    <div class="symbol symbol-circle symbol-25px float-right">
                                        <div class="symbol-label bg-dark">
                                                    <span
                                                        class="fs-9 text-white">+{!! collect(\App\Models\Parlamento\Mainheader::activitiesUsers($item->id, 'Livewire.Forms.Cabecalho.MenuForm'))->count() !!}</span>
                                        </div>
                                    </div>

                                </div>
                            </td>
                            <td class="">
                                <button type="button"
                                        class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                        data-kt-table-widget-4="expand_row">
                                <span class="svg-icon svg-icon-3 m-0 toggle-off"
                                      wire:click.prevent="openDetalhes({{$item->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1"
                                              transform="rotate(-90 11 18)" fill="black"></rect>
                                        <rect x="6" y="11" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                </button>
                                <button type="button"
                                        class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px cursor-pointer"
                                        data-kt-table-widget-4="expand_row" wire:click.prevent="openDelete({{$item}})">
                                <span class="svg-icon svg-icon-3 m-0 toggle">
                                    <i class="fa fa-trash"></i>
                                </span>
                                </button>
                            </td>
                        </tr>

                        @foreach($item->groupsHasViews as $i)
                            <tr data-kt-table-widget-4="subtable_template"
                                @if(!($openDetails == $item->id)) class="d-none" @endif >
                                <td colspan="2">
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                            <img
                                                src="{{ Auth::user()->getAvatarN(collect(\App\Models\Parlamento\Group::activitiesUsers($item->id, 'Livewire.Forms.Permissoes.NewGroup'))->first()['primavera_email']??'laravel.admin@parlamento.ao')  }}"
                                                data-kt-src-path="/good/assets/media/stock/ecommerce/" alt=""
                                                data-kt-table-widget-4="template_image">
                                        </a>
                                        <div class="d-flex flex-column text-muted">
                                            <a href="#" class="text-dark text-hover-primary fw-bolder"
                                               data-kt-table-widget-4="template_name">{{ $i->name_views }}</a>
                                            <div class="fs-7"
                                                 data-kt-table-widget-4="template_description">{{ Date::parse($i->created_at)->format('d M,Y') . ' - ' .Date::parse($i->created_at)->format('d M,Y')}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="text-dark fs-7">Nivel de Acesso {{ $i->id }}</div>
                                    <div class="text-muted fs-7 fw-bolder" data-kt-table-widget-4="template_cost">
                                        @if($i->crate_permission)
                                            <span
                                                class="badge badge-light-primary badge-sm">CRIAR</span>
                                        @endif
                                        @if($i->read_permission)
                                            <span
                                                class="badge  badge-light-warning badge-sm">LEITURA</span>
                                        @endif
                                        @if($i->update_permission)
                                            <span
                                                class="badge  badge-light-info badge-sm">ACTUALIZAR</span>
                                        @endif
                                        @if($i->delete_permission)
                                            <span
                                                class="badge  badge-light-danger badge-sm">ELIMINAR</span>
                                        @endif
                                        @if($i->publishte_permission)
                                            <span
                                                class="badge  badge-light-dark badge-sm">PUBLICAR</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="">
                                    <div class="text-dark fs-7 me-3">Alter os niveis de acesso</div>
                                    <div class="d-flex fw-bold pb-0" wire:init="carregar({{ collect($i) }})">

                                        <div class="form-check form-check-custom me-9 ">
                                            <input class="form-check-input " type="checkbox"
                                                   wire:model="data.{{$i->id}}.crate_permission"
                                                   wire:change.prevent="clickedFirst({{ collect($i) }})">
                                            <label class="form-check-label ms-3" for="email">Criar</label>
                                        </div>

                                        <div class="form-check form-check-custom me-9">
                                            <input class="form-check-input " type="checkbox"
                                                   wire:change.prevent="clickedFirst({{ collect($i) }})"
                                                   wire:model="data.{{$i->id}}.delete_permission">
                                            <label class="form-check-label ms-3" for="phone">Eliminar</label>
                                        </div>

                                        <div class="form-check form-check-custom me-9 ">
                                            <input class="form-check-input " type="checkbox"
                                                   wire:change.prevent="clickedFirst({{ collect($i) }})"
                                                   wire:model="data.{{$i->id}}.update_permission">
                                            <label class="form-check-label ms-3" for="phone">Actualizar</label>
                                        </div>
                                        <div class="form-check form-check-custom me-9 ">
                                            <input class="form-check-input  " type="checkbox"
                                                   wire:change.prevent="clickedFirst({{ collect($i) }})"
                                                   wire:model="data.{{$i->id}}.publishte_permission">
                                            <label class="form-check-label ms-3" for="phone">Publicar</label>
                                        </div>
                                        <div class="form-check form-check-custom me-9 ">
                                            <input class="form-check-input mb-1" type="checkbox"
                                                   wire:change.prevent="clickedFirst({{ collect($i) }})"
                                                   wire:model="data.{{$i->id}}.read_permission"
                                                   checked="checked">
                                            <label class="form-check-label ms-3" for="phone">Leitura</label>
                                        </div>


                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="symbol-group symbol-hover mb-1">
                                        <!--begin::Member-->

                                        @foreach(\App\Models\Parlamento\Group::activitiesUsers($item->id, 'Livewire.Forms.Permissoes.NewGroup') as $userActives)
                                            <div class="symbol symbol-circle symbol-25px">
                                                <img
                                                    src="{{ auth()->user()->getAvatarN( $userActives['primavera_email']) }}"
                                                    alt="">
                                            </div>
                                        @endforeach

                                        <div class="symbol symbol-circle symbol-25px float-right">
                                            <div class="symbol-label bg-dark">
                                                    <span
                                                        class="fs-9 text-white">+{!! collect(\App\Models\Parlamento\Mainheader::activitiesUsers($item->id, 'Livewire.Forms.Cabecalho.MenuForm'))->count() !!}</span>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                                <td class="">
                                    <div class="text-dark fs-7 me-3">Acção</div>
                                    <div class="text-muted text-end fs-7 fw-bolder"
                                         data-kt-table-widget-4="template_stock">
                                        <div class="badge badge-light-success cursor-pointer"
                                             wire:click.prevent="delectEvent({{$i}})"><i
                                                class="fa fa-trash"></i> Eliminar
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach

                    @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Table Widget 4-->
    </div>
</div>
@push('scripts')
    <script>

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initSelector()
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
                initSelector()
            })

        });
        initSelector();

        function initSelector() {


            $('#SelectorEstado').select2({
                minimumResultsForSearch: -1
            }).on('change', () => {

                @this.
                set('activactInfo', $('#SelectorEstado').val())
            });


            var colors = ['#ff0000', '#00ff00', '#0000ff'];
            var random_color = colors[Math.floor(Math.random() * colors.length)];
            document.getElementsByClassName('title').style.background = random_color;
        }
    </script>
@endpush
