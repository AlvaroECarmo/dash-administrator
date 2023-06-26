<div>

    <div class="card-body m-0 pb-0 pl-0 pr-0 pt-0"
         style="overflow-x: auto!important; min-height: {{ config('Departments.440px') }}">

        <table class="table table-striped table-sm table-hover table-bordered" wire:poll.10000ms="render">
            <thead>
            <tr class="text-uppercase text-sm text-muted">
                <th>Funcionário</th>
                <th class="d-none d-sm-table-cell" style="width: 18%">Falta</th>
                <th class="d-none d-sm-table-cell" style="width: 18%">Justificada</th>
                <th class="d-none d-sm-table-cell" style="width: 18%">Estado</th>
                {{--<th class="d-none d-sm-table-cell" style="width: 8%">acção</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($worklist as $linhas)
                <tr style="vertical-align: center">

                    <td class="">
                        <span class="font-weight-bold text-success" style="font-size: 14px">-</span> &nbsp;
                        {{ $linhas['nomeFuncionario'] }}
                    </td>
                    <td class="">
                        {{ Date::parse($linhas['created_at'])->format('d-m-Y, H:i.s') }}
                    </td>
                    <td class="">
                        {{ Date::parse($linhas['created_at'])->format('d-m-Y, H:i.s') }}
                    </td>
                    {{-- <td class="">
                         {{ Date::parse($linhas['updated_at'])->format('d-m-Y,  H:i.s') }}
                     </td>--}}
                    <td class="d-none d-sm-table-cell">
                        @include('livewire.listas.component.data-table.status-td', ['isManager'=>$linhas['isManager'],'isDRH'=>$linhas['isDrh']])
                    </td>

                    {{-- <td --}}{{--style="width: 180px; text-align: right"--}}{{-->
                         <div class="btn-group text-sm justify-content-end text-right">
                             <a class="text-secondary btn-sm text-danger float-right" data-toggle="tooltip"
                                style="cursor: pointer" wire:click.prevent="deleteWorkList({{ $linhas }})"
                                title="Eliminar a justificação com o seu fluxo">
                                 <i class="far fa-trash-alt"></i> </a>
                         </div>
                     </td>--}}
                </tr>
            @endforeach
            </tbody>

        </table>
        <div class="mt-1 mr-1 d-flex justify-content-end">
            {{$worklist->links()}}
        </div>

    </div>

    @livewire('comuns.action-delete-work-list')
    <div class="card-footer">

        {{-- <button class="btn btn-warning  mr-1 btn-sm mb-2 mb-sm-0" style="width: 120px"
                 wire:click.prevent="gerarPDF">
             <i class="fa fa-file-pdf" wire:loading.remove></i>
             <span class="spinner-border spinner-border-sm align-items-center" role="status"
                   aria-hidden="true" disabled wire:loading></span>
             <span wire:loading.remove>Estatística</span>
             <span wire:loading disabled>Aguarde...</span>
         </button>
         @if($pdfGerado)
             <a class="btn btn-primary  mr-1 btn-sm " href="{{$pdfGerado}}" download>
                 <i class="fa fa-download mr-1"></i>Estatistica das avaliações por area.PDF
             </a>
         @endif--}}
    </div>

</div>
@push('scripts')
    <script>
        window.addEventListener('update-id_pessoa', evt => {
        @this.set('funcionario', evt.detail.ID);
        })
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {

            })

            Livewire.hook('message.processed', (message, component) => {

            })
        });

    </script>
@endpush
