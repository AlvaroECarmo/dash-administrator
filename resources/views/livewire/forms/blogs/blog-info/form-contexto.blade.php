<div>
    <div class="card bg-body mb-9 mb-xl-0 me-xl-9">

        <div class="card-body pb-6">
            <input type="hidden" wire:model="event.id">
            <!--begin::blog-->
            <div class="mb-17">
                <!--begin::Title-->
                <div class="row">
                    <div class="col-12 col-sm-5">
                        <div class="form-group mb-3">
                            <label class="required">Página</label>
                            <select class="form-select form-select-sm @error('menuId') is-invalid @enderror"
                                    id="selectMenus"
                                    wire:model="capaData.menuId"
                                    data-allow-clear="true" data-control="select2"
                                    data-placeholder="Seleciona a pagina">
                                <option></option>
                                @foreach($itemMenu as $e)
                                    @if($e->class != 'dropdown')
                                        @if($e->url != "/")
                                            <option value="{{ $e->id }}">{{ __($e->parents?$e->parents['context']:'####') .' - '. $e->context }}</option>
                                        @endif
                                    @endif

                                @endforeach

                            </select>
                            @error('menuId')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>

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

                <form>
                    <div class="row">
                        <div class="col-12 col-sm-3">
                            <div class="form-group mb-3">
                                <label class="required">Titulo</label>
                                <input type="text"
                                       class="form-control form-control-sm @error('title') is-invalid @enderror"
                                       wire:model="capaData.title"
                                       placeholder="Escreve aqui o titulo"/>

                                @error('title')
                                <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="form-group mb-4">
                                <label class="">Descrição</label>
                                <input type="text" class="form-control form-control-sm"
                                       wire:model="capaData.context"
                                       placeholder="Escreve aqui a Descrição"/>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2 row">

                        <div class="col-sm input-group text-right justify-content-end">
                            <button type="button" class="btn btn-light-primary btn-sm mr-2"
                                    wire:click.prevent="cabaBlogPageSave">
                                Guardar a informação
                            </button>
                        </div>
                    </div>
                </form>
                <!--end::Wrapper-->
                @livewire('forms.blogs.blog-info.lista-capas')
                <div class="separator border-secondary my-10"></div>

                <!--begin::Text-->
                <input type="hidden" wire:model="event.idContextBlog">
                @include('livewire.forms.blogs.blog-info.components.form-blog-page')

            </div>
            <!--end::blog-->
        </div>

        @livewire('forms.blogs.blog-info.sugestoes-blog')
        @include('livewire.forms.blogs.blog-info.components.crop-image')

    </div>

</div>
@include('livewire.forms.blogs.blog-info.components.form-context-component')
@push('page_css')

    <style>

    </style>
@endpush

{{--
<textarea id="[id_here]" name="[name_here]" wire:ignore.self
          placeholder="cria aqui a sua nova pagina"
          hidden></textarea>--}}
