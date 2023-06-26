{{--


--}}
@section('third_party_scripts')
    <script>
        $(document).ready(function () {
            toastr.options = {
                "positionClass": "toast-bottom-right",
                "progressBar": true,
            }

            window.addEventListener('mostra-erro', event => {
                toastr.error(event.detail.message, 'Erro');
            });

            window.addEventListener('hide-form', event => {
                $('{{ $idNameModel }}').modal('hide');

                if (event.detail.error === true) {
                    toastr.error(event.detail.message, 'Erro');
                } else {
                    toastr.success(event.detail.message, 'Sucesso');
                }
            });

            window.addEventListener('show-form', event => {
                $('{{ $idNameModel }}').modal('show');
            });
        });

    </script>
@endsection
