<div class="col-xl-6">
    <!--begin::Media-->
    <div class="h-100 d-flex flex-column justify-content-between pe-xl-6 mb-xl-0 mb-10">
        <!--begin::Wrapper-->
        <div class="overlay mt-2">
            <!--begin::Image-->
            <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-325px"
                 id="imageUpload" wire:ignore></div>
            <!--end::Image-->
            <!--begin::Links-->
            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                @if($photo)
                    <a class="btn btn-sm btn-light-danger"
                       wire:click.prevent="removeUpload">Remover</a>
                    <a href="{{ $photo->temporaryUrl() }}"
                       class="btn btn-light-warning ms-3 btn-sm overlay"
                       data-fslightbox="lightbox-hot-sales">Exibir</a>
                @else
                    <a class="btn btn-sm btn-light-primary"
                       wire:click.prevent="uploadImage">Carregar</a>
                    <a href="/assets/about-1.jpg"
                       class="btn btn-light-warning ms-3 btn-sm overlay"
                       data-fslightbox="lightbox-hot-sales">Exibir</a>
                @endif
            </div>
            <!--end::Links-->
        </div>
        <input type="file" id="uploadMesa" class="d-none" accept=".png, .jpeg, .jpg"
               wire:model.defer="photo"/>
        <!--end::Wrapper-->
    </div>
    <!--end::Media-->
</div>
