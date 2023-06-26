<div class="col-12 col-xl-6">
    <div class="overlay mb-11 @error('imgCapa') bg-danger @enderror">
        <!--begin::Image-->

        <div id="imagens" wire:ignore
             class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px overlay-wrapper"
             style="background-position: center; background-size: 100% "></div>
        <!--end::Image-->
        <!--begin::Links-->
        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 ">
            @if(!$image)
                <a href="#" id="uploadImage" class="btn btn-sm btn-light-primary"
                   wire:click.prevent="uploadImage">Carregar</a>
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
                <a href="{{ asset($image) }}" class="badge badge-primary badge-sm badge-circle p-4 cursor-pointer"
                   download
                   style="position: absolute; bottom: 10px; right: 10px ; z-index: 1000"><i
                        class="fa fa-download text-white"></i></a>
            @endif

        </div>
        <input type="file" id="upload" class="d-none" name="uploadfile" accept=".png, .jpeg, .jpg"/>

        <!--end::Links-->
        <!--info::mensagem de erro em caso que não foi selecionado a imagem-->
        @error('imgCapa')
        <span class="form-text text-white">{{ $message }}</span>
        @enderror
    </div>
</div>


