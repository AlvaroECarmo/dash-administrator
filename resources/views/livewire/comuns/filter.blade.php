<div class="card-header pl-0 pr-0">


    <div class="d-flex align-items-end float-right pl-0 pr-0 m-0" wire:ignore>


        @livewire('listas.component.datapicker.range-datapicker')

        &nbsp;
        <div class="input-group " style="max-width: 180px">
            <input type="text" class="form-control float-right p-3 reservation" placeholder="Data da falta" >
            <div class="input-group-prepend ">
                <span class="input-group-text bg-red text-muted text-white" style="cursor: pointer"> x </span>
            </div>
        </div>
        &nbsp;
        @include('livewire.comuns.search-views')


    </div>

    @if(session()->has('error'))
        <div class="alert bg-gradient-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <span>{{ session()->get('error') }}</span>
        </div>
    @endif


</div>
