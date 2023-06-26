<div>
    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog"
         data-backdrop="static"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>

        <div
            class="modal-dialog modal-lg modal-dialog-centered  "
            role="document">
            @if($loadVews)
                <div class="overlay-wrapper">
                    <div class="overlay bg-white"><i class="fas fa-2x fa-sync-alt fa-spin mr-3"></i>
                        <div class="text-bold pt-2">Aguarde...</div>
                    </div>
                </div>
            @endif
            <div class="modal-content">
                <form action="">
                    <div class="card  {{ $cardColor?$cardColor:'card-primary' }}">
                        <div class="card-header {{ $cardColor?$cardColor:'card-primary' }}">
                            <h3 class="card-title"><i class="fa fa-balance-scale mr-1"></i>
                                {{ $title }}
                            </h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body ">
                            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1 text-center pt-4">
                                <i class="fa fa-recycle fa-10x"></i>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary mr-1 closeModal" id="closeModal"
                                        {{--data-dismiss="modal"--}} wire:click.prevent="closing">
                                    <i class="fa fa-times-circle mr-1"></i>Cancelar
                                </button>

                                {!! $actioButton !!}

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        window.addEventListener('show-eliminar', event => {
            $('#{{ $modalId }}').modal('show');
        });

        /*
        window.addEventListener('show-form-disapprove', event => {
            $('#disapprovedEvaluationStatus').modal('show');
        @this.set('evaluationStatus', event.detail.evaluationStatus);
        });
       ;
        window.addEventListener('show-form-homolog', event => {
            $('#approveEvaluationStatusSgan').modal('show');
        @this.set('evaluationStatus', event.detail.evaluationStatus);
        });*/

        window.addEventListener('close{{ $modalId }}', event => {
            $('.modal').modal('hide');
            if (event.detail.error === true) {
                toastr.error(event.detail.message, 'Erro');
            } else {
                toastr.success(event.detail.message, 'Justificação de Faltas');
            }
        @this.emit('subformIsClosed');
        });

        window.addEventListener('closeModal', ev => {
            $('.modal').modal('hide');
        });

    </script>
@endpush
