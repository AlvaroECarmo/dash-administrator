<div>
    <div class="card-body p-lg-10">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-3 mt-2">
                <select class="form-select  form-select-sm @error('schedulesSection') is-invalid @enderror"
                        id="schedulesSection"
                        wire:model.defer="schedulesSection"
                        data-allow-clear="true"
                        data-placeholder="Selecione aqui o conteudo a publicar">
                    <option></option>
                    @foreach($schedulesSections as $e1)
                        <option value="{{ $e1['id'] }}">{{ $e1['title']  }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-2 mt-2">
                <div class="input-group">
                    <button type="button" class="btn btn-sm btn-success mr-2" wire:click.prevent="moverImg">
                        Publica Alterações
                    </button>
                </div>
            </div>
        </div>
        <div class="separator separator-dashed my-4"></div>
        <div class="mb-15">
            <h3 class="text-dark mb-7">Mesa do presídio</h3>
            <div class="separator separator-dashed mb-9"></div>
            <div class="d-flex flex-wrap justify-content-center">
                <!--begin::Member-->
                @forelse($deputadosPresidio as $item)

                    <div class="d-flex flex-column text-center mb-11 me-5 me-lg-15 " style="border-radius: 10px">
                        <!--begin::Photo-->

                        <div class="symbol symbol-200px symbol-lg-200px mb-4 text-left">
                            <img src="{{ Storage::url($item->url) }}" class="" width="250" alt="">
                        </div>

                        <!--end::Photo-->
                        <!--begin::Info-->
                        <div class="text-left">
                            <!--begin::Info
                                       <div class="separator my-2"></div>
                            -->

                            <div class="mb-5 mt-3">
                                <details class="btn btn-sm btn-light-info btn-hover-rise w-100 pt-4 text-left" style="text-align: left!important;">
                                    <div
                                        style="max-width: 210px!important; width: 210px!important; height: 70px;max-height: 70px"
                                        class="mt-5">
                                        <div class="text-left" style="text-align: left!important;">
                                            {!! $item->name !!}
                                        </div>

                                        <div class="text-left text-muted"
                                             style="text-align: left!important;">{{ $item->category }}</div>
                                    </div>
                                    <div class="mt-5">
                                        <span class="badge badge-sm badge-light-info">{{ $item->id }}</span>
                                        @foreach( $item->socialites as $social)
                                            <a href="{{ '//'. $social->href }}" target="_blank"
                                               class="badge badge-light-white cursor-pointer border border-primary ">
                                                <i class="{{ $social->icon }} text-primary  ml-2"></i>
                                            </a>
                                        @endforeach
                                        <span
                                            class="badge badge-light-danger cursor-pointer text-center border border-primary "
                                            wire:click.prevent="alterarElemento({{ $item }})">
                                        <i class="far fa-edit text-info  ml-2"></i>
                                        </span>
                                        <span
                                            class="badge badge-light-danger cursor-pointer border border-primary "
                                            wire:click.prevent="deleteElement({{ $item }})">
                                            <i class="fa fa-trash text-danger ml-2"></i>
                                        </span>
                                    </div>
                                </details>


                            </div>
                            <!--end::Position-->
                        </div>
                        <!--end::Info-->
                    </div>
                @empty
                    <h1 class="fw-bolder text-dark mb-3 fs-3qx lh-sm text-hover-primary text-center">
                        Não foi ensirido deputados <br>
                        da mesa do presidio
                    </h1>
            @endforelse

            <!--end::Member-->
            </div>
        </div>
        <!--end::Latest posts-->


    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('confirm-event', evt => {
            confirmSwit(evt.detail.message).then((result) => {
                if (result.isConfirmed) {
                    @this.
                    set('confirm', true)
                }
            });
        })
        iniSelector();
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                iniSelector();
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
                iniSelector();
            })
        });

        function iniSelector() {
            $("#schedulesSection").select2().on('change', () => {
                @this.
                set('schedulesSection', $("#schedulesSection").select2("val"))
            });
        }

        window.addEventListener('show-fails', evt => {
            toastr.error(evt.detail.message, 'erro')
        })


    </script>
@endpush
