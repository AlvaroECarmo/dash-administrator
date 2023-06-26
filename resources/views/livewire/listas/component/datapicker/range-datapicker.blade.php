<div class="input-group " style="max-width: 440px">

    <div class="input-group-prepend">
        <span class="input-group-text">De </span>
    </div>
    <input type="text" class="form-control float-right p-3 mr-1 reservation {{--text-right--}}"
           style="width: 160px!important;max-width:160px!important; height: 40px"
           wire:model.defer="rangeDate.initialDate"
           autocomplete="off"
           placeholder="{{ config('Departments.InitialDate') }}" id="dataInitial">
    <div class="input-group-prepend">
        <span class="input-group-text"> à </span>
    </div>
    <input type="text" class="form-control float-right p-3 reservation {{--text-right--}}"
           style="width: 160px!important;max-width:160px!important; height: 40px "
           wire:model.defer="rangeDate.finalDate"
           autocomplete="off"
           placeholder="{{ config('Departments.FinalDate') }}" id="dataFinal">
    <div class="input-group-prepend ">
        <span class="input-group-text bg-red text-muted text-white" style="cursor: pointer" wire:click.prevent="resetMethod"> x </span>
    </div>
</div>
@push('scripts')
    <script>
        $('.reservation').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            language: "pt"
        });

        $('#dataInitial').on('change', function () {
            // alert($(this).val());
        @this.set('rangeDate.initialDate', $(this).val());
        });

        $('#dataFinal').on('change', function () {
            // alert($(this).val());
        @this.set('rangeDate.finalDate', $(this).val());
        });
    </script>
@endpush
