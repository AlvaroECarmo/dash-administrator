<div class="overlay mb-11 @error('imgCapa') bg-danger @enderror">
    <!--begin::Image-->

    <div id="imagens" wire:ignore
         class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px overlay-wrapper "
         style="background-position: center; background-size: 100% "></div>

    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 ">
        @if(!$image)
            <a href="#" id="uploadImage" class="btn btn-sm btn-light-primary"
               wire:click.prevent="uploadImage"
            >Carregar</a>
            &nbsp;&nbsp;
            <a class="btn btn-sm btn-light-warning shadow d-block overlay"
               href="{{ asset('assets/media/page-title.jpg') }}"
               data-fslightbox="lightbox-hot-sales">
                Exibir
            </a>
        @else
            <button class="btn btn-sm btn-light-danger"
                    wire:click.prevent="removeImage">Remover
            </button>
            &nbsp;&nbsp;
            <a class="btn btn-sm btn-light-warning shadow d-block overlay"
               href="{{ $image }}"
               data-fslightbox="lightbox-hot-sales">
                Exibir
            </a>
        @endif

    </div>

    @error('imgCapa')
    <span class="form-text text-white">{{ $message }}</span>
    @enderror
</div>
<input type="file" id="upload" hidden name="uploadfile" accept=".png, .jpeg, .jpg"/>
<input type="text" id="uploadfile" hidden name="upload" accept=".png, .jpeg, .jpg"/>

@push('script')
    <script>
        imageBackground();
        window.addEventListener('upload-image-click', event => {
            $('#upload').click();
        })

        function imageBackground(image = '') {
            $('#imagens').css("background-image", "url('assets/media/page-title.jpg')");
            if (image != '') {
                $('#imagens').css("background-image", "url(" + image + ")");
            }
        }

        window.addEventListener('activeFunctionality', evt => {
            imageBackground(evt.detail.temp_image);
        });
        $(document).ready(function () {

            $('#upload').ijaboCropTool({
                preview: '.image-previewer',
                setRatio: 3,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['ADICIONAR', 'CANCELAR'],
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
    </script>
@endpush
