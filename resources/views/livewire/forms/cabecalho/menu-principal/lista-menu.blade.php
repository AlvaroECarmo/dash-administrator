<div class="col-xl-12 mb-12 mb-xxl-12 ">

    <div class="col-12 mt-2">
        <div class="input-group">
            <button type="button" class="btn btn-sm btn-light-success mr-2" wire:click.prevent="publishInfo">
                Publica Alterações
            </button>
        </div>
    </div>
    <div class="separator separator-dashed my-15"></div>
    <div class="justify-content-end row">
        <div class="col-12 col-sm-3">
            <div class="form-group mb-3">
                <input type="text" class="form-control form-control-sm" wire:model="nameSeach"
                       placeholder="pesquise aqui o menu">
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="form-group mb-3">
                <input type="text" class="form-control form-control-sm" wire:model="nameInterno"
                       placeholder="pesquise aqui o sub menus">
            </div>
        </div>
    </div>
    <div class="card card-flush pb-0 scroll-x scroll-y h-500px">


        <div class="card-body pt-1 pb-0 mb-0">
            <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-0"
                   data-kt-table-widget-3="all">
                <tbody wire:sortable="updateTaskOrder" class="accordion accordion-icon-toggle p-0 m-0"
                       id="kt_accordion_2">
                @foreach ($listMenu as $item)
                    <!--begin::Body-->
                    <tr wire:sortable.item="{{ $item->id }}" wire:key="item-{{ $item->id }}">
                        <td class=" p-0 m-0">
                            <table style=" width: 100%!important;">

                                <tr class="accordion-header d-flex collapsed border-0 p-0 m-0"
                                    style="width: 100%!important;" data-bs-toggle="collapse"
                                    data-bs-target="#kt_accordion_2_item_3A{{ $item['id'] }}">
                                    <td style=" width: 40%!important; min-width: 220px!important;">
                                        <div class="position-relative ps-6 pe-3 py-2">
                                            <div
                                                class="position-absolute start-0 cursor-move top-0 w-10px h-100 rounded-2 bg-light-primary"
                                                wire:sortable.handle>
                                            </div>
                                            <a href="#" class="mb-1 text-dark text-hover-primary fw-bolder">
                                                {{ $item['context'] }}
                                            </a>
                                            <br/>
                                            <label for=""
                                                   class="text-sm text-muted">{{ $item['url']?:'não foi inserido um link' }}</label>
                                        </div>
                                    </td>
                                    <td style=" width: 10%!important; min-width: 70px!important;"
                                        class="text-right pr-3">
                                        <span class="font-weight-bold text-muted">{{ $item['ordem'] }}</span> ª <br/>
                                        <label for="" class="text-muted">Posição</label>
                                    </td>
                                    <td style=" width: 20%!important;">

                                        <di>
                                            @if ($item['class'] == 'dropdown')
                                                <div class="fs-7  fw-bolder text-muted">Tem Sub Item</div>
                                            @else
                                                <div class="fs-7  fw-bolder text-muted">Não Tem Sub Item</div>
                                            @endif
                                        </di>
                                        <label class="text-muted">informação</label>

                                    </td>

                                    <td style=" width: 20%!important;" class="min-w-125px">
                                        <!--begin::Team members-->
                                        <div class="symbol-group symbol-hover mb-1">
                                            <!--begin::Member-->
                                            @foreach(\App\Models\Parlamento\Mainheader::activitiesUsers($item->id, 'Livewire.Forms.Cabecalho.MenuForm') as $userActives)
                                                <div class="symbol symbol-circle symbol-25px">
                                                    <img
                                                        src="{{ auth()->user()->getAvatarN( $userActives['primavera_email']) }}"
                                                        alt="">
                                                </div>
                                        @endforeach

                                        <!--begin::More members-->
                                            <div class="symbol symbol-circle symbol-25px float-right">
                                                <div class="symbol-label bg-dark">
                                                    <span
                                                        class="fs-9 text-white">+{!! collect(\App\Models\Parlamento\Mainheader::activitiesUsers($item->id, 'Livewire.Forms.Cabecalho.MenuForm'))->count() !!}</span>
                                                </div>
                                            </div>
                                            <!--end::More members-->
                                        </div>
                                        <!--end::Team members-->
                                        <div class="fs-7 font-weight-light text-muted">Membro da equipa</div>
                                    </td>
                                    <td class="min-w-150px">
                                        <label>Criado </label>
                                        <div class="mb-2 font-weight-light text-muted">
                                            {{ Date::parse($item['created_at'])->format('d-m-Y H:i.s') }}
                                        </div>

                                    </td>
                                    <td class="d-none">Pending</td>
                                    <td style="width: 2%!important;" class="text-right justify-content-end">
                                        <button type="button" data-bs-toggle="collapse"
                                                wire:click.prevent="editingThenParent({{$item}})"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-success toggle h-25px w-25px float-right">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="collapse"
                                                wire:click.prevent="deleteThenParent({{$item}})"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-danger toggle h-25px w-25px float-right">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @if($item['class'] == 'dropdown')
                                    <tr id="kt_accordion_2_item_3A{{ $item['id'] }}"
                                        class="collapse fs-6 ps-10 p-0 m-0" data-bs-parent="#kt_accordion_2">
                                        <td>
                                            <div class="card p-3">

                                                <table class="w-100 ml-2">
                                                    @if ($item['class'] == 'dropdown')
                                                        @foreach ($item->getElements() as $subitem)
                                                            <tr>
                                                                <td class="main-td"
                                                                    style="width: 30%">{{ $subitem->context }}</td>
                                                                <td><span
                                                                        class="badge badge-light-primary">Menu Item</span>
                                                                <td><span
                                                                        class="badge badge-light-success">activo</span>
                                                                </td>
                                                                <td>{{ 'Utilizador de Desenvolvimento' }}</td>
                                                                <td>{{ Date::parse($subitem->created_at)->format('d-m-Y H:i.s') }}</td>
                                                                <td>{{ Date::parse($subitem->updated_at)->format('d-m-Y H:i.s') }}</td>
                                                                <td style="width: 10%">
                                                                    <button type="button" data-bs-toggle="collapse"
                                                                            wire:click.prevent="editingThenParent({{$subitem}})"
                                                                            class="btn btn-sm btn-icon btn-light btn-active-light-success toggle h-25px w-25px">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    &nbsp;
                                                                    <button type="button" data-bs-toggle="collapse"
                                                                            wire:click.prevent="deleteThenParent({{$subitem}})"
                                                                            class="btn btn-sm btn-icon btn-light btn-active-light-danger toggle h-25px w-25px">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @if($subitem['class'] == 'dropdown')
                                                                @foreach ($subitem->getElements() as $subitemtd)

                                                                    <tr class="ml-4">
                                                                        <td class="main-td"
                                                                            style="width: 30%">
                                                                            - &nbsp;&nbsp;{{ $subitemtd->context }}</td>
                                                                        <td><span
                                                                                class="badge badge-light-primary">Menu Item</span>
                                                                        <td><span
                                                                                class="badge badge-light-success">activo</span>
                                                                        </td>
                                                                        <td>{{ 'Utilizador de Desenvolvimento' }}</td>
                                                                        <td>{{ Date::parse($subitemtd->created_at)->format('d-m-Y H:i.s') }}</td>
                                                                        <td>{{ Date::parse($subitemtd->updated_at)->format('d-m-Y H:i.s') }}</td>
                                                                        <td style="width: 10%">
                                                                            <button type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    wire:click.prevent="editingThenParent({{$subitemtd}})"
                                                                                    class="btn btn-sm btn-icon btn-light btn-active-light-success toggle h-25px w-25px">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>
                                                                            &nbsp;
                                                                            <button type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    wire:click.prevent="deleteThenParent({{$subitemtd}})"
                                                                                    class="btn btn-sm btn-icon btn-light btn-active-light-danger toggle h-25px w-25px">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>

                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    <!--end::Body-->
                @endforeach
                </tbody>
            </table>
            {{-- <div> {{ $listMenu->links() }}</div>--}}
        </div>


    </div>

</div>

@push('page_css')
    <style>
        .draggable-mirror {
            background-color: white;
            width: 1024px;
            min-width: 924px !important;
            justify-content: space-between;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        }

        .draggable-mirror tr td {
            background-color: white;
            width: 224px;
            min-width: 224px !important;
        }

        /*.draggable-mirror tr td .main-td{
            background-color: white;
            width: 300px!important;
         }*/
    </style>
@endpush


@push('scripts')
    <script>

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

        /* window.addEventListener('init-Component', event => {
             alert('Ola como estas');
         })*/
    </script>
@endpush
