@extends('layouts.app')

@section('third_party_stylesheets')
    <style>
        .livewire-pagination {

            @apply inline-block w-auto ml-auto float-right;
        }

        ul.pagination {

            @apply flex border border-gray-200 rounded font-mono;
        }

        .page-link {

            @apply block bg-white text-blue-800 border-r border-gray-200 outline-none py-2 w-12 text-sm text-center;
        }

        .page-link:last-child {

            @apply border-0;
        }

        .page-link:hover {

            @apply bg-blue-700 text-white border-blue-700;
        }

        .page-item.active .page-link {

            @apply bg-blue-700 text-white border-blue-700;
        }

        .page-item.disabled .page-link {

            @apply bg-white text-gray-300 border-gray-200;
        }
    </style>
@endsection

@section('content')

    @livewire('comuns.sub-header',[
    'titleApplication'=>'Justificação de faltas',
    'titleArea'=>'Ambiente do administrador',
    'departament'=>'Permissões',])

    <div class="container-fluid ">
        @livewire('permissoes.permissoes-group')
    </div>

@endsection
@section('third_party_scripts')
    <script>

        /* window.addEventListener('close-formManager', event => {
             $('.modal').modal('hide');
             if (event.detail.error === true) {
                 toastr.error(event.detail.message, 'Erro');
             } else {
                 toastr.success(event.detail.message, 'Justificação de Faltas');
             }
         });*/

    </script>
@endsection
