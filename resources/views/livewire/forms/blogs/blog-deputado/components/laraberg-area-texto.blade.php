<div class="form-group  mt-2 mb-3">
    <div class="" wire:ignore>
        <label class="required badge badge-light-info">Resumo do Histórico</label>
        <textarea class="form-control" hidden id="[id_here]" name="[name_here]"
                  wire:ignore.self rows="5"></textarea>
    </div>
    @error('titleContext')
    <span class="form-text text-danger">{{ $message }}</span>
    @enderror

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

    <script>

        const element = document.getElementById('[id_here]');
        initSelectorTY();
        var modalContent = $('.imageEditor');
        var options = {
            aspectRatio: 16 / 9,
            preview: '.img-preview',
            ready: function (e) {
                console.log(e.type);
            },
            cropstart: function (e) {
                console.log(e.type, e.detail.action);
            },
            cropmove: function (e) {
                console.log(e.type, e.detail.action);
            },
            cropend: function (e) {
                console.log(e.type, e.detail.action);
            },
            crop: function (e) {
                var data = e.detail;

                console.log(e.type);
                dataX.value = Math.round(data.x);
                dataY.value = Math.round(data.y);
                dataHeight.value = Math.round(data.height);
                dataWidth.value = Math.round(data.width);
                dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
                dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
                dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
            },
            zoom: function (e) {
                console.log(e.type, e.detail.ratio);
            }


        };
        var imageGaleria = document.getElementById('imageGaleria');

        var cropper;
        var Cropper = window.Cropper;
        var URL = window.URL || window.webkitURL;
        var container = document.querySelector('.img-container');
        var image = container.getElementsByTagName('img').item(0);
        var actions = document.getElementById('actions');
        var dataX = document.getElementById('dataX');
        var dataY = document.getElementById('dataY');
        var dataHeight = document.getElementById('dataHeight');
        var dataWidth = document.getElementById('dataWidth');
        var dataRotate = document.getElementById('dataRotate');
        var dataScaleX = document.getElementById('dataScaleX');
        var dataScaleY = document.getElementById('dataScaleY');
        var listFile;
        var i = 0;

        async function initSelectorTY() {

            const mediaUpload = ({filesList, onFileChange}) => {

                setTimeout(async () => {

                    var data = new FormData;
                    Array.from(filesList).map(file => {
                        modalContent.modal('show')
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#imageGaleria').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(file);
                        data.append('ficheiro', file);

                    });


                    modalContent.on('shown.bs.modal', function () {

                        cropper = new Cropper(imageGaleria, options);
                        actions.querySelector('.docs-toggles').onchange = function (event) {
                            var e = event || window.event;
                            var target = e.target || e.srcElement;
                            var cropBoxData;
                            var canvasData;
                            var isCheckbox;
                            var isRadio;


                            if (!cropper) {
                                return;
                            }

                            if (target.tagName.toLowerCase() === 'label') {
                                target = target.querySelector('input');
                            }

                            isCheckbox = target.type === 'checkbox';

                            isRadio = target.type === 'radio';

                            if (isCheckbox || isRadio) {
                                if (isCheckbox) {
                                    options[target.name] = target.checked;
                                    cropBoxData = cropper.getCropBoxData();
                                    canvasData = cropper.getCanvasData();

                                    options.ready = function () {
                                        console.log('ready');
                                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                                    };
                                } else {
                                    options[target.name] = target.value;
                                    options.ready = function () {
                                        console.log('ready');
                                    };
                                }

                                // Restart
                                cropper.destroy();
                                cropper = new Cropper(image, options);

                            }

                            console.log('Docs - Toggles ...');

                        };

                        actions.querySelector('.docs-buttons').onclick = function (event) {
                            var e = event || window.event;
                            var target = e.target || e.srcElement;
                            var cropped;
                            var result;
                            var input;
                            var data;

                            if (!cropper) {
                                return;
                            }

                            while (target !== this) {
                                if (target.getAttribute('data-method')) {
                                    break;
                                }

                                target = target.parentNode;
                            }

                            if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
                                return;
                            }

                            data = {
                                method: target.getAttribute('data-method'),
                                target: target.getAttribute('data-target'),
                                option: target.getAttribute('data-option') || undefined,
                                secondOption: target.getAttribute('data-second-option') || undefined
                            };

                            cropped = cropper.cropped;

                            if (data.method) {
                                if (typeof data.target !== 'undefined') {
                                    input = document.querySelector(data.target);

                                    if (!target.hasAttribute('data-option') && data.target && input) {
                                        try {
                                            data.option = JSON.parse(input.value);
                                        } catch (e) {
                                            console.log(e.message);
                                        }
                                    }
                                }

                                switch (data.method) {
                                    case 'rotate':
                                        if (cropped && options.viewMode > 0) {
                                            cropper.clear();
                                        }

                                        break;

                                    case 'getCroppedCanvas':
                                        try {
                                            data.option = JSON.parse(data.option);
                                        } catch (e) {
                                            console.log(e.message);
                                        }

                                        if (uploadedImageType === 'image/jpeg') {
                                            if (!data.option) {
                                                data.option = {};
                                            }

                                            data.option.fillColor = '#fff';
                                        }

                                        break;
                                }

                                result = cropper[data.method](data.option, data.secondOption);

                                switch (data.method) {
                                    case 'rotate':
                                        if (cropped && options.viewMode > 0) {
                                            cropper.crop();
                                        }

                                        break;

                                    case 'scaleX':
                                    case 'scaleY':
                                        target.setAttribute('data-option', -data.option);
                                        break;

                                    case 'getCroppedCanvas':
                                        if (result) {
                                            // Bootstrap's Modal
                                            $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                                            if (!download.disabled) {
                                                download.download = uploadedImageName;
                                                download.href = result.toDataURL(uploadedImageType);
                                            }
                                        }

                                        break;

                                    case 'destroy':
                                        cropper = null;

                                        if (uploadedImageURL) {
                                            URL.revokeObjectURL(uploadedImageURL);
                                            uploadedImageURL = '';
                                            image.src = originalImageURL;
                                        }

                                        break;
                                }

                                if (typeof result === 'object' && result !== cropper && input) {
                                    try {
                                        input.value = JSON.stringify(result);
                                    } catch (e) {
                                        console.log(e.message);
                                    }
                                }
                            }

                            console.log('Docs Buttons');
                        };

                        $('.croppers').on('click', () => {

                            var setCopper = cropper.getCroppedCanvas({
                                width: 160,
                                height: 90,
                                minWidth: 256,
                                minHeight: 256,
                                maxWidth: 4096,
                                maxHeight: 4096,
                                fillColor: '#fff',
                                imageSmoothingEnabled: false,
                                imageSmoothingQuality: 'high',
                            });


                            setCopper.toBlob(async (blob) => {

                                const file = new File([blob], new Date() + blob.type, {
                                    lastModifiedDate: new Date(),
                                    fileName: new Date() + blob.type,
                                    type: blob.type,
                                });


                                data.append('croppedImage', file);

                                const information = await axios.post("{{ route('sendCropped') }}", data, {
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }).then(function (response) {

                                    onFileChange([{
                                        id: 0,
                                        name: response.data.msg,
                                        url: response.data.msg
                                    }])

                                    $('.imageEditor').modal('hide')

                                })


                            });
                        })


                    })


                }, 1000)


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
