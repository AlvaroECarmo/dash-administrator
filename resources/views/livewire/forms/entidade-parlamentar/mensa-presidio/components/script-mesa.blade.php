@push('scripts')
    <script>
        initSelector();
        document.addEventListener("DOMContentLoaded", () => {

            Livewire.hook('component.initialized', (component) => {
                initSelector();
            })
            Livewire.hook('element.initialized', (el, component) => {

            })
            Livewire.hook('element.updating', (fromEl, toEl, component) => {

            })
            Livewire.hook('element.updated', (el, component) => {
            })
            Livewire.hook('element.removed', (el, component) => {
            })
            Livewire.hook('message.sent', (message, component) => {

            })
            Livewire.hook('message.failed', (message, component) => {
            })
            Livewire.hook('message.received', (message, component) => {
            })
            Livewire.hook('message.processed', (message, component) => {
                initSelector();
            })
        });


        function initSelector() {
            $('#select_entidade').select2().on('change', () => {
                const ent = $('#select_entidade').select2('val');
                @this.
                set('data.typeWebApp', ent)
            });

            $('#deputadoSelector').select2().on('change', () => {
                const func = $('#deputadoSelector').select2('val');
                @this.
                set('data.codFuncionario', func)
            });

            $('#scheduleSection').select2().on('change', () => {
                const scheduleSection_id = $('#scheduleSection').select2('val');
                @this.
                set('data.scheduleSection_id', scheduleSection_id)
            });

            $('#selectIconSub').select2().on('change', function () {
                let data = $('#selectIconSub').select2("val")
                    // $("#imagsItem").attr("src", data);

                    @this.set('socialite.icon', data)
                    @this.set('icon', data)
            });

            $("#data_elito").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {format: 'DD-MM-YYYY'},
                    minYear: 1901,
                    maxYear: parseInt(moment().format("YYYY"), 10)
                }, function (start, end, label) {
                    //var years = moment().diff(start, "years");
                    @this.
                    set('data.dataEleito', start.format('DD-MM-YYYY'))
                }
            );


        }


        window.addEventListener('upload-image-click', () => {
            $('#uploadMesa').click();
        })
        window.addEventListener('activeFunctionality', evt => {
            window.imageBack.init(evt.detail.temp_image, '/assets/schedule-5.jpg', '#imageUpload');
        });
        window.imageBack.init('', '/assets/schedule-5.jpg', '#imageUpload');

        window.addEventListener('event-success', evt => {
            toastr.success(evt.detail.message, 'Novo Registro');
        })

        window.addEventListener('event-error', evt => {
            toastr.error(evt.detail.message, 'Erro');
        })

    </script>
@endpush
