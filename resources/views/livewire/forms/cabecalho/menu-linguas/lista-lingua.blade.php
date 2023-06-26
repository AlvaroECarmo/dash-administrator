<div class="col-xl-12 mb-12 mb-xxl-12">
    <div class="card card-flush">

        <div class="card-body pt-1">
            <table id="kt_widget_table_3"
                   class="table table-row-dashed align-middle fs-6 gy-2 my-0 pb-0"
                   data-kt-table-widget-3="all">

                </thead>


                <tbody>
                @foreach($headercontentList as $item)
                    <tr>
                        <td class="min-w-175px" style="width: 60%!important;">
                            <div class="position-relative ps-6 pe-3 py-2">
                                <div
                                    class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-light-info"></div>
                                {{ $item->context .' - '. $item->designation }}
                                <div class="fs-7 text-muted font-weight-light">{{ $item->created_at }}</div>
                            </div>
                        </td>

                        <td>
                            <!--begin::Team members-->
                            <div class="symbol-group symbol-hover mb-1">
                                <!--begin::Member-->
                                @foreach(\App\Models\Parlamento\Mainheader::activitiesUsers($item->id, 'Livewire.Forms.Cabecalho.FormLingua') as $userActives)
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
                        <td class="min-w-150px">
                            <div
                                class="mb-2 fw-bolder">{{ Date::parse($item->updated_at)->format('d-m-Y H:s.i')}}</div>
                            <div class="fs-7 font-weight-light text-muted">Data actulizada</div>
                        </td>
                        <td class="d-none">Pending</td>
                        <td class="text-end">
                            &nbsp;
                            <button type="button" wire:click.prevent="updateElement({{$item}})"
                                    class="btn btn-icon btn-sm btn-light btn-active-primary w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </button>

                            <button type="button" wire:click.prevent="receiveElementToDelete({{$item}})"
                                    class="btn btn-icon btn-sm btn-light btn-active-danger w-25px h-25px">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                <i class="fa fa-trash "></i>
                                <!--end::Svg Icon-->
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>


            </table>
        </div>

        <div>
            {{ $headercontentList->links() }}
        </div>


        <div class="modal" tabindex="-1" id="modal-delete-element">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title text-white">Eliminar a lingual</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1>{{ $data['designation'] }}</h1>
                        <p>Confirma para eleminar o item selecionado!</p>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" wire:click.prevent="deleteElement">Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="separator separator-dashed my-15"></div>
    <div class="col-12 mt-2">
        <div class="input-group">
            <button type="button" class="btn btn-sm btn-light-success mr-2" wire:click.prevent="publishInfoHeader">
                Publica Alterações
            </button>
        </div>
    </div>

</div>
@push('scripts')
    <script>
        window.addEventListener('show-modal', event => {
            $('#modal-delete-element').modal('show');
        })

        window.addEventListener('hide-modal', event => {
            $('#modal-delete-element').modal('hide');
        })
    </script>
@endpush
