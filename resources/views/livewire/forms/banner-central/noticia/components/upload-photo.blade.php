<div class="overlay mb-11">
    <!--begin::Image-->

    <div id="imagens" wire:ignore
         class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px overlay-wrapper"
         style="background-position: center; background-size: 100% 420px"></div>

    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
        @if(!$image)
            <a href="#" id="uploadImage" class="btn btn-sm btn-light-primary"
               wire:click.prevent="uploadImage"
            >Carregar</a>
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
            <a href="{{$image}}" class="badge badge-primary badge-sm badge-circle"
               style="position: absolute; bottom: 10px; right: 10px" download><i
                    class="fa fa-download text-white"></i></a>
        @endif


    </div>

    <input type="file" id="upload" hidden name="uploadfile" accept=".png, .jpeg, .jpg"/>
    <input type="text" id="uploadfile" hidden name="upload" accept=".png, .jpeg, .jpg"/>


</div>


