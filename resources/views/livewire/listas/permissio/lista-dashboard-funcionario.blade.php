<div>

    <div class="card-body m-0 pb-0 pl-0 pr-0 pt-0"
         style="overflow-x: auto!important; min-height: {{ config('Departments.440px') }}">

        <table class="table table-striped table-sm table-hover table-bordered" wire:poll.10000ms="render">
            <thead>
                @include('livewire.listas.permissio.tableview.heder-table')
            </thead>
            <tbody>

            @foreach($listaMembers as $linhas)
                @include('livewire.listas.permissio.tableview.table-view')
            @endforeach
            </tbody>

        </table>

        <div class="mt-1 mr-1 d-flex justify-content-end">
            {{$listaMembers->links()}}
        </div>

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
