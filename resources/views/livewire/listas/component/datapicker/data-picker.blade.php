<div class="input-group d-flex justify-content-end">

    <input type="text" class="form-control float-right p-3 mr-1 dataPiker"
           style="width: 220px!important;max-width:220px!important; height: 40px"
           wire:model.defer="data"
           autocomplete="off"
           placeholder="Data da falta">
</div>

@push('scripts')
    <script>
        $('.dataPiker').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            language: "pt"
        }).on('change', function () {            // alert($(this).val());
        @this.set('data', $(this).val());
        });
    </script>
@endpush
