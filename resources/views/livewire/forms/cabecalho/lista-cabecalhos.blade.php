<div class="col-xl-12 mb-12 mb-xxl-12 ">
    <div class="menu-item m-0 p-0">
        <h4 class="menu-content text-muted mb-0 fs-7 text-uppercase">Historico de registros</h4>
    </div>
    <div class="card card-flush  pb-0 scroll-x">
        <div class="card-body pt-1 pb-0 mb-0 accordion accordion-icon-toggle p-0 m-0" id="kt_accordion_2">
            @livewire('forms.cabecalho.sub-form-cabecalho')
            <table class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-0">
                <tbody wire:sortable="updateTaskOrder">
                @foreach($dataList as $item)
                    <tr wire:sortable.item="{{ $item->id }}" wire:key="item-{{ $item->id }}">
                        <td class=" p-0 m-0">
                            <table style=" width: 100%!important; padding: 0px" wire:target="sendEvent">
                                <tr class="accordion-header d-flex collapsed border-0 p-0 m-0"
                                    style="width: 100%!important;" aria-expanded="{{ $status['parent'] }}">

                                    <td style=" width: 30%!important;  min-width: 220px!important;">
                                        <div class="position-relative ps-6 pe-3 py-2">
                                            <div class="position-absolute start-0 top-0 w-10px h-100 rounded-2
                                                cursor-move
                                                {{ $item->status?'bg-success':'bg-light-warning ' }} "
                                                 wire:sortable.handle>
                                            </div>
                                            <a href="#"
                                               class="mb-1 text-dark text-hover-primary fw-bolder">{{ $item->date_region }}</a>
                                            <div class="fs-7 text-muted font-weight-light">Publicado
                                                ao {{ Date::parse($item->created_at)->format('d').' de ' .Date::parse($item->created_at)->format('M Y')}}
                                            </div>
                                        </div>
                                    </td>

                                    @isset($item->socialitesList[0])
                                        <td style=" width: 20%!important;">
                                            <!--begin::Icons-->
                                            <div class="d-flex gap-2 mb-2">
                                                @foreach($item->socialitesList as $social)

                                                    @if($social->icon == 'fab fa-facebook')
                                                        <a href="#">
                                                            <img src="assets/media/svg/brand-logos/facebook-4.svg"
                                                                 class="w-20px" alt=""/>
                                                        </a>
                                                    @elseif($social->icon == 'fab fa-linkedin')
                                                        <a href="#">
                                                            <img src="assets/media/svg/brand-logos/twitter-2.svg"
                                                                 class="w-20px" alt=""/>
                                                        </a>

                                                    @elseif($social->icon == 'fab fa-youtube')
                                                        <a href="#">
                                                            <img src="assets/media/svg/brand-logos/youtube-3.svg"
                                                                 class="w-20px" alt=""/>
                                                        </a>
                                                    @elseif($social->icon == 'fab fa-twitter')
                                                        <a href="#">
                                                            <img src="assets/media/svg/brand-logos/twitter-2.svg"
                                                                 class="w-20px" alt=""/>
                                                        </a>
                                                    @endif
                                                @endforeach

                                            </div>
                                            <!--end::Icons-->
                                            <div class="fs-7 text-muted fw-bolder">Redes Sociais</div>
                                        </td>
                                    @endif

                                    @isset($item->linksBox[0])
                                        <td style=" width: 20%!important;">
                                            <!--begin::Icons-->
                                            <div class="d-flex gap-2 mb-2">
                                                @foreach($item->linksBox as $boxList)
                                                    <a href="{{ $boxList->url }}">
                                                   <span
                                                       class="text-uppercase font-weight-bold fw-bolder badge badge-light-primary">
                                                       {{ substr( $boxList->context, 0, 2) }}
                                                   </span>
                                                    </a>

                                                @endforeach

                                            </div>
                                            <!--end::Icons-->
                                            <div class="fs-7 text-muted fw-bolder">Caixa de links</div>
                                        </td>
                                    @endif

                                    @isset($item->inforList[0])
                                        <td style=" width: 20%!important;">
                                            <!--begin::Icons-->
                                            <div class="d-flex gap-2 mb-2">
                                                @foreach($item->inforList as $boxInfo)
                                                    <a href="{{ $boxInfo->url }}">
                                                   <span
                                                       class="text-uppercase font-weight-bold fw-bolder badge badge-light-primary">
                                                       {{ substr( $boxInfo->context, 0, 2) }}
                                                   </span>
                                                    </a>

                                                @endforeach

                                            </div>
                                            <!--end::Icons-->
                                            <div class="fs-7 text-muted fw-bolder">Caixa de Informação</div>
                                        </td>
                                    @endif

                                    @isset($item->listLange[0])
                                        <td style=" width: 20%!important;">
                                            <!--begin::Icons-->
                                            <div class="d-flex gap-2 mb-2">
                                                @foreach($item->listLange as $boxLingua)
                                                    <a href="#">
                                                   <span
                                                       class="text-uppercase font-weight-bold fw-bolder badge badge-light-primary">
                                                       {{ $boxLingua->context }}
                                                   </span>
                                                    </a>

                                                @endforeach

                                            </div>
                                            <!--end::Icons-->
                                            <div class="fs-7 text-muted fw-bolder">Caixa de Linguas</div>
                                        </td>
                                    @endif

                                    <td style=" width: 20%!important;" class="min-w-125px">
                                        <!--begin::Team members-->
                                        <div class="symbol-group symbol-hover mb-1">
                                            <!--begin::Member-->
                                            @foreach(\App\Models\Parlamento\Mainheader::activitiesUsers($item->id, 'Livewire.Forms.Cabecalho.FormsCabecalhos') as $userActives)
                                                <div class="symbol symbol-circle symbol-25px">
                                                    <img
                                                        src="{{ auth()->user()->getAvatarN( $userActives['primavera_email']) }}"
                                                        alt="">
                                                </div>
                                        @endforeach

                                        <!--begin::More members-->
                                            <div class="symbol symbol-circle symbol-25px">
                                                <div class="symbol-label bg-dark">
                                                    <span class="fs-9 text-white">+0</span>
                                                </div>
                                            </div>
                                            <!--end::More members-->
                                        </div>
                                        <!--end::Team members-->
                                        <div class="fs-7 font-weight-light text-muted">Membro da equipa</div>
                                    </td>
                                    <td style=" width: 20%!important;">
                                        @if($item->status)
                                            <span class="badge badge-success">Activado</span>
                                        @else
                                            <span class="badge badge-light-warning">Pendente</span>
                                        @endif
                                    </td>
                                    <td class="min-w-150px">
                                        <div
                                            class="mb-2 fw-bolder">{{ Date::parse($item->created_at)->format('d, M Y H:i.s') }}</div>
                                        <div class="fs-7 fw-bolder text-muted">data de criação</div>
                                    </td>

                                    <td style="width: 10%!important;" class="text-right justify-content-end p-4">
                                        <button type="button" data-bs-toggle="collapse"
                                                wire:click.prevent="editingThenParent({{$item}})"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-success toggle h-25px w-25px">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="collapse"
                                                wire:click.prevent="deleteThenParent({{$item}})"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-danger toggle h-25px w-25px">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button"
                                                wire:click.prevent="openSocialiteModal({{ $item }})"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px">

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

                                    </td>
                                </tr>


                            </table>
                        </td>

                    </tr>

                @endforeach
                </tbody>

            </table>
            <div class="separator separator-dashed mb-0 p-0"></div>

        </div>


    </div>
    <div class="p-2 flex float-end justify-content-end ">
        {{ $dataList->links() }}
    </div>
    <div class="separator separator-dashed my-15"></div>
    <div class="col-12 mt-2">
        <div class="input-group">
            <button type="button" class="btn btn-sm btn-light-success mr-2" wire:click.prevent="publishInfo">
                Publica Alterações
            </button>
        </div>
    </div>


</div>

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

        const randomColor = "#" + ((1 << 24) * Math.random() | 0).toString(16);

        document.documentElement.style.setProperty('--main-bg-color', randomColor);

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

        window.addEventListener('open-socialite-form', evt => {
            $('#socializeForme').modal('show');
        });


    </script>
@endpush
