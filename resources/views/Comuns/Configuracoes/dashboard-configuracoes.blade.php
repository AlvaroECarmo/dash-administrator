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
    'departament'=>'Configurações',])

    <div class="container-fluid ">
        @livewire('configs.dashboard-configuracoes')
    </div>

@endsection
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
                $('#formFuncionario').modal('hide');

                toastr.success(event.detail.message, 'Sucesso');
            });

            window.addEventListener('message-alert', evt => {
                toastr.warning(evt.detail.message, 'Seleciona a falta!');
            })
            window.addEventListener('message-alert-2', evt => {
                toastr.warning(evt.detail.message, 'Alerta!...');
            })

            window.addEventListener('show-form', event => {
                $('#formFuncionario').modal('show');
            });

            window.addEventListener('show-delete-form', event => {
                $('#formConfirmation').modal('show');
            });

            window.addEventListener('hide-delete-form', event => {
                $('#formConfirmation').modal('hide');
                if (event.detail.error === true) {
                    toastr.error(event.detail.message, 'Erro');
                } else {
                    toastr.success(event.detail.message, 'Sucesso');
                }
            });
        });


        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "{{route('dropzone.store')}}", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            maxFilesize: 1,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
        })

        myDropzone.on("addedfile", function (file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function () {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function (progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function () {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }

        window.addEventListener('upload-file', event => {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        });

        document.querySelector("#actions .cancel").onclick = function () {
            myDropzone.removeAllFiles(true)
        }


    </script>
@endsection
