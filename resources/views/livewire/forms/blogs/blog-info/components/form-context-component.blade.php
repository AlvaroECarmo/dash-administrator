@push('scripts')
    <script>

        initSelector()
        const element = document.getElementById('[id_here]');
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initSelector()
                initSelectorTY();

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
                initSelector()


            })
        });

        function initSelector() {

            $('#selectMenus').select2().on('change', () => {

                const ele = $('#selectMenus').select2("val");
                @this.
                set('capaData.menuId', ele);
                @this.
                set('itemMenuId', ele);
            });

        }

        window.addEventListener('show-fails', evt => {
            toastr.error(evt.detail.message);
        })
        $('#selectIcon').on('change', function (e) {
            $('#viewIcon').removeClass().addClass($('#selectIcon').select2("val"))
        });

        window.addEventListener('upload-image-click', event => {
            $('#upload').click();
        })

        imageBackground();

        function imageBackground(image = '') {
            $('#imagens').css("background-image", "url('assets/media/page-title.jpg')");
            if (image != '') {
                $('#imagens').css("background-image", "url(" + image + ")");
            }
        }

        window.addEventListener('activeFunctionality', evt => {
            imageBackground(evt.detail.temp_image);
        });

        window.addEventListener('success-send', evt => {
            toastr.success(evt.detail.message);
        })


        $(document).ready(function () {

            $('#upload').ijaboCropTool({
                preview: '.image-previewer',
                setRatio: 3,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['INSERIR', 'CANCELAR'],
                buttonsColor: ['#30bf7d', '#ee5155', -15],
                processUrl: '{{ route("crop") }}',
                withCSRF: ['_token', '{{ csrf_token() }}'],
                onSuccess: function (message, element, status) {
                    imageBackground()
                    @this.set('imageEditada', message);
                },
                onError: function (message, element, status) {
                    alert()
                }
            });

        });


        initSelectorTY();

        async function initSelectorTY() {

            const mediaUpload = ({filesList, onFileChange}) => {
                setTimeout(async () => {
                    let data = new FormData;
                    Array.from(filesList).map(file => {
                        data.append('ficheiro', file);
                    });

                    const information = await axios.post("{{ route('sendimage') }}", data, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(function (response) {
                        return response.data.msg;
                    })

                    const uploadedFiles = Array.from(filesList).map(file => {
                        return {
                            id: file.id,
                            name: file.name,
                            url: information
                        }
                    })

                    onFileChange(uploadedFiles)
                }, 1000)
            }

            const hooks = Laraberg.wordpress.hooks

            const settings = {
                mediaUpload: mediaUpload,
                imageEditing: true,
                supportsLayout: true,
                titlePlaceholder: 'inseri um titulo para pagina',
                bodyPlaceholder: 'Escreva aqui as informações do blog',
                alignWide: true,
                hasFixedToolbar: true,
                colors: ['#000000'],
                hasMenuItems: true,
                locale: "pt-br",
                theme: "bootstrap",
                mediaLibrary: window.filemanager,
                isRTL: true,
                language: "pt",
                postLock: {
                    isLocked: false
                },
                availableTemplates: [],
                allowedBlockTypes: true,
                disableCustomColors: true,
                disablePostFormats: true,
                hasBlockSupport: true,
                hasPermissionsToManageWidgets: true,
            }

            hooks.addFilter('blocks.registerBlockType', 'block-editor', (settings, blockName) => {
                return settings
            })


            Laraberg.init('[id_here]', settings)


        }

        element.addEventListener('change', (e) => {
            @this.
            set('conteudoData.context', e.target.value)
        })

        window.addEventListener('editorEditing', evt => {

            Laraberg.removeEditor(element)
            element.innerHTML = evt.detail.contexto;
            initSelectorTY()

        })
    </script>
@endpush
