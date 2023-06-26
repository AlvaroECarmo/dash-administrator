<div class="form-group  mt-2 mb-3">
    <div class="" wire:ignore>
        <label class="required badge badge-light-info">Resumo do Histórico</label>
        <textarea class="form-control" hidden id="[id_here]" name="[name_here]"
                  wire:ignore.self rows="5"></textarea>
    </div>
    @error('titleContext')
    <span class="form-text text-danger">{{ $message }}</span>
    @enderror
    <button id="showws">Show</button>
    <div class="modal fade imageEditor" id="modal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="modalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Edição de image</h5>
                </div>
                <div class="modal-body">
                    @include('livewire.forms.blogs.blog-deputado.components.context-image-cropper')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm croppers" data-dismiss="modal">Salvar
                    </button>

                    <button type="button" class="btn btn-danger btn-sm closeModal" data-dismiss="modal">Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
@push('scripts')
    <script src="{{ asset('assets/cropper/edit/cropper.js') }}"></script>
    <script src="{{ asset('assets/cropper/main.js') }}"></script>

    <script>
        const element = document.getElementById('[id_here]');
        initSelectorTY();
        const imageGaleria = $('#imageGaleria');


        async function initSelectorTY() {

            const mediaUpload = ({filesList, onFileChange}) => {

                setTimeout(async () => {

                    let data = new FormData;

                    Array.from(filesList).map(file => {

                        $('.imageEditor').modal('show')

                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#imageGaleria').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(file);



                        const imageGS = document.getElementById('imageGaleria');

                        window.onload(undefined);

                        $('.croppers').on('click', async () => {

                        });
                            //window.cropper.destroy();
                        //  console.log(file)

                         $('#imageGaleria').src = URL.createObjectURL(file);
                        data.append('ficheiro', file);
                    });

                }, 1000)

                setTimeout(() => {
                    $('.docs-tooltip')[13].click();
                }, 1500);

                console.log($('.docs-tooltip')[13])
            }

            $('.closeModal').on('click', () => {
                $('.imageEditor').modal('hide')
            })

            const hooks = Laraberg.wordpress.hooks

            const settings = {
                mediaUpload: mediaUpload,
                imageEditing: true,
                supportsLayout: true,
                titlePlaceholder: 'Adicione um titulo da pagina',
                bodyPlaceholder: 'Escreva aqui as informações da blog',
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
            set('data.otherProfessionalQualifications', e.target.value)
        })

        window.addEventListener('editorEditingDeputados', evt => {

            Laraberg.removeEditor(element)
            element.innerHTML = evt.detail.contexto;
            initSelectorTY()

        })

    </script>
@endpush
