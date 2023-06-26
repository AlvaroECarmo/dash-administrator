<div class="card">
    {{-- é importante que esteja sempre dentro de uma card view--}}
    <div class="card-header d-flex p-0 text-left">

        <ul class="nav nav-pills  p-2">
            <li class="nav-item" wire:click.prevent="listener('FaltasInjustificadas')">
                <a class="nav-link {{ $tab1 }}" href="#faltasInjustificadas"
                   data-toggle="tab">
                    Configurações
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        @include('livewire.comuns.session-notification')
        <div class="card-header pl-0 pr-0">


            <div class="d-flex align-items-end float-right pl-0 pr-0 m-0" wire:ignore>


                @livewire('listas.component.datapicker.range-datapicker')

                &nbsp;
                <div class="input-group " style="max-width: 180px">
                    <input type="text" class="form-control float-right p-3 reservation" placeholder="Data da falta" >
                    <div class="input-group-prepend ">
                        <span class="input-group-text bg-red text-muted text-white" style="cursor: pointer"> x </span>
                    </div>
                </div>
                &nbsp;
                @include('livewire.comuns.search-views')


            </div>

            @if(session()->has('error'))
                <div class="alert bg-gradient-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span>{{ session()->get('error') }}</span>
                </div>
            @endif


        </div>
        <div class="tab-content">
            <div class="tab-pane {{ $tab1 }} p-0" id="faltasInjustificadas">
                @livewire('forms.configuracoes.dashboard-configuracoes')
            </div>

        </div>
    </div>

</div>

@push('scripts')
    <script>
        initSelector();
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initSelector();
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
                initSelector();
            })
        });

        function initSelector() {
            $('#funcionario').select2({
                language: "pt",
                allowClear: true,
                placeholder: 'Selecione o funcionario',


            }).on('change', function (e) {
                var data = $('#funcionario').select2("val");
            @this.set('funcionario', data);
            });

            $(document).on('select2:open', () => {
                console.log(this);
                document.querySelector('.select2-search__field').focus();
            });

        }


        window.addEventListener('close-formManager', event => {
            $('.modal').modal('hide');
            if (event.detail.error === true) {
                toastr.error(event.detail.message, 'Erro');
            } else {
                toastr.success(event.detail.message, 'Justificação de Faltas');
            }
        @this.emit('subformIsClosed');
        });


        $('.reservation').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            language: "pt"
        });


    </script>
@endpush
