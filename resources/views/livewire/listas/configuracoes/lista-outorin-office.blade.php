<div>

    <div class="card-body m-0 pb-0 pl-0 pr-0 pt-0"
         style="overflow-x: auto!important; min-height: {{ config('Departments.440px') }}">

        <table class="table table-striped table-sm table-hover table-bordered" {{--wire:poll.10000ms="render"--}}>
            <thead>
            <tr class="text-uppercase text-sm text-muted">
                <th style="width: 25%">Director</th>
                <th style="width: 25%;">Director Interino</th>
                <th class="d-none d-sm-table-cell" style="width: 10%">Inicio</th>
                <th class="d-none d-sm-table-cell" style="width: 10%">Final</th>
                <th class="d-none d-sm-table-cell" style="width: 10%">Estado</th>
                <th class="d-none d-sm-table-cell" style="width: 10%">acção</th>
            </tr>
            </thead>
            <tbody>
            @foreach($outInOfOffice as $out)
                <tr style="vertical-align: center">

                    <td class="">
                        <span class="font-weight-bold text-danger" style="font-size: 14px">
                            <i class="fas fa-sign-out-alt"></i>
                        </span> &nbsp;
                        {{ $out['managerName'] }}
                    </td>
                    <td class="">
                        <span class="font-weight-bold text-success" style="font-size: 14px">
                            <i class="fas fa-sign-out-alt"></i>
                        </span> &nbsp;
                        {{ $out['name'] }}
                    </td>
                    <td class="">
                        {{ Date::parse($out['outOffice'])->format('d-m-Y') }}
                    </td>
                    <td class="">
                        {{ Date::parse($out['inOffice'])->format('d-m-Y') }}
                    </td>
                    <td class="">
                        @if ($out['outOffice'])
                            <span class="font-weight-bold text-danger">Ausente</span>
                        @else
                            <span class="font-weight-bold text-danger">Prensete</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <a class="text-primary" style="cursor: pointer"
                           wire:click.prevent="anularOutOffe({{ $out }})">
                            <i class="fas fa-sign-in-alt"></i> Anular
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>
        <div class="mt-1 mr-1 d-flex justify-content-end">
            {{$outInOfOffice->links()}}
        </div>
        @livewire('comuns.action-delete-out-of-office-permission')
    </div>


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
