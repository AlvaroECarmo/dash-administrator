<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="row">
        @foreach($tabbtnslists as $t)
            <div class="d-flex py-5 col-sm-2 bg-white border border-right-1 border-primary ml-3"
                 style="border-radius: 10px; margin-left: 10px">
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap">
                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bolder pe-6">{{ $t->context }}</a>
                    </div>
                    <span class="text-gray-800 fs-7 fw-normal pt-1">
                        {{ $t->schedulesSection->title }}
                    </span>
                </div>
                <button class="badge badge-circle badge-danger"
                        wire:click.prevent="eliminarTabs('{{ $t->id }}')"
                        style="position: relative;margin-top: -12px; margin-left: -30px; border: none">
                    <i class="fa fa-trash text-white"></i>
                </button>
            </div>
        @endforeach

        {{--<div class="col-sm-2">
            <div type="button" class="btn btn-block w-100 btn-sm btn-primary mr-2 text-left">

            </div>
        </div>--}}
        <div class="col-sm-12 mt-3">
            <button type="button" class="btn btn-sm btn-primary mr-2" wire:click.prevent="openConfiguracao">
                Adicionar as configurações
            </button>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {

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

            })
        });


        window.addEventListener('open-modal-apresentacao', evt => {
            $('#openSeccaoApresentacao').modal('show');
        })
        window.addEventListener('close-modal-event', evt => {
            $('#openSeccaoApresentacao').modal('hide');
            toastr.success(evt.detail.message);
        })

        window.addEventListener('message-success', evt => {
            toastr.success(evt.detail.message);
        })


        window.addEventListener('send-success', event => {


            toastr.success(event.detail.message);
        })

    </script>
@endpush
