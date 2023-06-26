{{--<div class="form-group mb-3 mt-2" wire:ignore>
    <label class="mb-2">Conteudo Informativo</label>
    <textarea wire:ignore.self class="form-control docs_ckeditor_classic"
              name="kt_docs_ckeditor_classic " id="docs_ckeditor_classic"
              wire:model.defer="data.description"
              rows="5"></textarea>
</div>--}}
<div class="form-group  mt-2 mb-3">
    <div class="" wire:ignore>
        <label class="required badge badge-light-info">Conteudo Descritivo</label>
        <textarea class="form-control" hidden id="[id_here]" name="[name_here]"
                  wire:ignore.self rows="5"></textarea>
    </div>
    @error('titleContext')
    <span class="form-text text-danger">{{ $message }}</span>
    @enderror

</div>
@push('scripts')
    <script>
        const element = document.getElementById('[id_here]');
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
            set('data.description', e.target.value)
        })

        window.addEventListener('editorEditing', evt => {

            Laraberg.removeEditor(element)
            element.innerHTML = evt.detail.contexto;
            initSelectorTY()

        })
    </script>
@endpush
