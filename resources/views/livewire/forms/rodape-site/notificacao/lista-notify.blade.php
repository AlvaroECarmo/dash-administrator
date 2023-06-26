<div class="col-xl-12 mb-12 mb-xxl-12 ">
    <div class="card card-flush h-xl-100 pb-0 scroll-x">

        <div class="card-body pt-1 pb-0 mb-0">
            <table id="kt_widget_table_3"
                   class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-0"
                   data-kt-table-widget-3="all">
                <tbody>
                <!--begin::Body-->
                @foreach($notify as $i)
                    <tr class="accordion accordion-icon-toggle p-0 m-0" id="kt_accordion_2">
                        <td class=" p-0 m-0">
                            <table style=" width: 100%!important;">
                                <tr class="accordion-header d-flex collapsed border-0 p-0 m-0"
                                    style="width: 100%!important;"
                                    data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_3">
                                    <td style="width: 50%!important; ">
                                        <div class="position-relative ps-6 pe-3 py-2">
                                            <div
                                                class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-info"></div>
                                            <a href="#" class="mb-1 text-dark text-hover-primary fw-bolder">
                                                {{  $i->title }}
                                            </a>

                                        </div>
                                    </td>

                                    <td style=" width: 20%!important;">
                                        <button type="button" data-bs-toggle="collapse"
                                                wire:click.prevent="wireEditting({{$i}})"
                                                class="btn btn-sm btn-light mr-2 btn-active-info  mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                            Alterar o conteudo
                                            <!--end::Svg Icon-->
                                        </button>
                                    </td>

                                    <td class="min-w-150px">
                                        <div
                                            class="mb-2 fw-bolder">{{ Date::parse($i->created_at)->format('d M, Y H:i.s') }}</div>

                                    </td>
                                    <td class="d-none">Pending</td>
                                    <td style="width: 25%!important;" class="text-right justify-content-end">
                                        <button type="button" data-bs-toggle="collapse"
                                                class="btn btn-sm mr-2 btn-light btn-active-success  mb-2"
                                                wire:click.prevent="publicarInfo({{$i}})"
                                        >
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                            Publicar
                                            <!--end::Svg Icon-->
                                        </button>
                                        &nbsp;
                                        <button type="button" data-bs-toggle="collapse"
                                                wire:click.prevent="removaPublica({{$i}})"
                                                class="btn btn-sm btn-light mr-2 btn-active-info   mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                            Remover Publicar
                                            <!--end::Svg Icon-->
                                        </button>
                                        &nbsp;
                                        <button type="button" data-bs-toggle="collapse"
                                                wire:click.prevent="deletar({{ $i }})"
                                                class="btn btn-sm btn-light mr-2 btn-active-danger  ">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                            Remover
                                            <!--end::Svg Icon-->
                                        </button>
                                    </td>
                                </tr>
                                <tr id="kt_accordion_2_item_3" class="collapse fs-6 ps-10 p-0 m-0"
                                    data-bs-parent="#kt_accordion_2">
                                    <td>
                                        <div
                                            class="fs-7 text-muted fw-bolder">{{  $i->context  }}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
                <!--end::Body-->
                </tbody>
            </table>
        </div>

    </div>
</div>
