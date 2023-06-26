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
                            <h4></h4>
                            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 160px">Nome</span>
                                    </div>
                                    <input type="text" class="form-control"
                                           wire:model.defer="justificacao.pessoaNome"
                                           disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend ">
                                <span class="border p-2 "
                                      style="width: 160px; border-radius: 4px 0 0 4px; background: rgba(206,212,218,0.53)">Observações</span>
                                    </div>
                                    <textarea type="text" class="form-control ve"
                                              wire:model.defer="observacoes"
                                              placeholder="Observações da justificação de faltas selecionadas"
                                              rows="6"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary mr-1"
                                        data-dismiss="modal">
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

        window.addEventListener('show-form-approve', event => {
            $('#aprovaJustificacao').modal('show');
        @this.set('justificacao', event.detail.justificacao);
        });

        window.addEventListener('show-form-rejected', event => {
            $('#rejeitarJustificacao').modal('show');
        @this.set('justificacao', event.detail.justificacao);
        })
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


    </script>
@endpush
