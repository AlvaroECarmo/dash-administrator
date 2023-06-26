<div>
    <div class="card-body p-lg-10">

        <div class="mb-15">
            <h3 class="text-dark mb-7">Mesa do presídio</h3>
            <div class="separator separator-dashed mb-9"></div>
            <div class="d-flex flex-wrap justify-content-center">
                <!--begin::Member-->
                @forelse($deputadosPresidio as $item)

                    <div class="d-flex flex-column text-center mb-11 me-5 me-lg-15" style="border-radius: 10px">
                        <!--begin::Photo-->
                        <div class="symbol symbol-200px symbol-lg-200px mb-4">
                            <img src="{{ Storage::url($item->url) }}" class="" width="250" alt="">

                        </div>

                        <!--end::Photo-->
                        <!--begin::Info-->
                        <div class="text-center">
                            <!--begin::Info-->
                            <div style="max-width: 210px!important; width: 210px!important; height: 65px"
                                  class="">
                                <span class="text-dark fw-bolder text-hover-primary fs-5">{!! $item->name !!}</span> -
                                <span class="text-muted">{{ $item->category }}</span>
                            </div>

                            <div class="separator my-2"></div>
                            <div class="mb-5 mt-3">
                                @foreach( $item->socialites as $social)
                                    <a href="{{ '//'. $social->href }}" target="_blank"
                                       class="badge badge-light-white badge-circle cursor-pointer border border-primary">
                                        <i class="{{ $social->icon }} text-primary"></i>
                                    </a>
                                @endforeach
                                <span class="badge badge-light-danger badge-circle cursor-pointer"
                                      wire:click.prevent="deleteElement({{ $item }})">
                                    <i class="fa fa-trash text-danger"></i>
                                </span>
                            </div>
                            <!--end::Position-->
                        </div>
                        <!--end::Info-->
                    </div>
                @empty
                    <h1 class="fw-bolder text-dark mb-3 fs-3qx lh-sm text-hover-primary text-center">
                        Não foi ensirido deputados <br>
                        da mesa do presidio
                    </h1>
            @endforelse

            <!--end::Member-->
            </div>
        </div>
        <!--end::Latest posts-->
        <div class="separator separator-dashed mb-9"></div>
        <h3 class="text-dark mb-7">Todos os Deputados</h3>
        <div class="col-xl-12 mb-12 mb-xxl-12 ">
            <div class="card card-flush h-xl-100 pb-0 scroll-x">

                <div class="card-body pt-1 pb-0 mb-0">
                    <table id="kt_widget_table_3"
                           class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-0"
                           data-kt-table-widget-3="all">
                        <tbody>
                        <div class="row mt-10">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm form-control-solid"
                                       placeholder="Escreva aqui o nome do deputado" wire:model="nomeDeputado">
                            </div>
                        </div>

                        @foreach($deputados as $itemDeputy)
                            <tr class="p-0 m-0 ">
                                <td class="p-0 m-0">
                                    <table style=" width: 100%!important; ">
                                        <tr class="accordion-header d-flex collapsed border-0 p-0 m-0"
                                            style="width: 100%!important;"
                                            data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_3">
                                            <td style=" width: 30%!important;  min-width: 220px!important; vertical-align: bottom">
                                                <div class="position-relative ps-6 pe-3 py-2">
                                                    <div class="row">
                                                        <div class="symbol symbol-65px symbol-lg-65px col-2">
                                                            <img src="/assets/gallery-10.jpg" class="" alt="">
                                                        </div>
                                                        <div class="col justify-content-end pt-3" style="">
                                                            <div class="position-absolute start-0
                                                                top-0 w-4px h-100 rounded-2 bg-light-info">
                                                            </div>
                                                            {{--<label class="btn btn-outline btn-outline-dashed
                                                                 p-1 active">--}}
                                                            <a class=" text-dark fw-bolder">
                                                                {{ $itemDeputy->fullName }}
                                                            </a> <br>
                                                            <div class="fs-7 text-sm">Nascido
                                                                aos {{ Date::parse($itemDeputy->bornDate)->format('d - m -Y')  }}</div>
                                                            <span class="text-left text-muted text-hover-primary text-xs
                                                                cursor-pointer pt-0 pb-0 pl-1 pr-1"
                                                                  wire:click.prevent="collImageSet({{ $itemDeputy }})"
                                                                  style="font-size: 12px">Insere a imagem
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style=" width: 40%!important;" class="pt-9">
                                                <span class="badge badge-light-primary text-left text-dark">
                                                    {{ $itemDeputy->parties?$itemDeputy->parties->shortName:'---'  }}
                                                </span> <br>
                                                <span class="">
                                                    {{ $itemDeputy->parties?$itemDeputy->parties->fullName:'não foi encontrado o seu partido' }}
                                                </span>
                                            </td>
                                            <td style=" width: 20%!important;" class="pt-9 active">
                                                <!--begin::Radio button-->
                                                <label class="btn btn-outline btn-outline-dashed cursor-pointer
                                                    d-flex flex-stack text-start p-1 ">
                                                    <label class="cursor-pointer">
                                                        <input class="form-check-input" type="radio"
                                                               name="plan{{$itemDeputy->id }}"/>
                                                        Publicado
                                                    </label>
                                                    <label class="cursor-pointer">
                                                        <input class="form-check-input" type="radio"
                                                               name="plan{{$itemDeputy->id }}" checked="checked"/>
                                                        Não Publicado
                                                    </label>

                                                </label>
                                                <span class="text-muted">
                                                    publicar as informações no portal
                                                </span>
                                            </td>
                                            <td style=" width: 10%!important;"
                                                class="text-right justify-content-end pt-8 float-right">

                                                <button type="button" data-bs-toggle="collapse"
                                                        class="btn  btn-sm btn-light btn-active-warning pt-1 pb-1 float-end mb-1">
                                                    <span class="svg-icon">
                                                        <i class="fa fa-eye"></i> Visualizar
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                <br>
                                                <button type="button" data-bs-toggle="collapse"
                                                        class="btn btn-sm btn-light btn-active-primary float-end pt-1 pb-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                    <span class="svg-icon">
                                                        <i class="fa fa-eye"></i> Aplicar
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div style="float: right;">
                        {{ $deputados->links() }}
                    </div>

                </div>

            </div>
        </div>

        <div class="col-12 mt-2">
            <div class="input-group">
                <button type="button" class="btn btn-sm btn-light-success mr-2" wire:click.prevent="moverImg">
                    Publica Alterações
                </button>
            </div>
        </div>

    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('confirm-event', evt => {
            confirmSwit(evt.detail.message).then((result) => {
                if (result.isConfirmed) {
                    @this.
                    set('confirm', true)
                }
            });
        })
    </script>
@endpush
