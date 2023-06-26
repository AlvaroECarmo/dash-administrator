<div id="kt_drawer_chat" class="bg-body {{ $classElement }}" data-kt-drawer="true" data-kt-drawer-name="chat"
     data-kt-drawer-activate="true"
     data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}"
     data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle"
     data-kt-drawer-close="#kt_drawer_chat_close">

    <div class="card w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">

        <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">

            <div class="card-title">

                <div class="d-flex justify-content-center flex-column me-3">
                    <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Sugestões</a>
                </div>

            </div>

            <div class="card-toolbar">
                <div class="me-2">

                    <div
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                        data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Contacts</div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_users_search">Add Contact</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_invite_friends">Invite Contacts
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                   title="Specify a contact email to send an invitation"></i></a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                            <a href="#" class="menu-link px-3">
                                <span class="menu-title">Groups</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Create
                                        Group</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Invite
                                        Members</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Settings</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-1">
                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Settings</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu 3-->
                </div>
                <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-2" wire:click.prevent="closView">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="black"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="black"/>
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </div>
            </div>

        </div>

        <div class="card-body" id="kt_drawer_chat_messenger_body">
            <div class="row">
                <div class="col-12 col-sm-5">
                    <div class="form-group mb-3">
                        <label class="required">Tittulo</label>
                        <input type="text"
                               class="form-control form-control-sm @error('auth') is-invalid @enderror "
                               wire:model.defer="sugestoes.title"
                               placeholder="Introduza o nome do autor"/>
                        @error('auth')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-7 ">
                    <div class="form-group mb-3">
                        <label class="required">Tipo midia</label>
                        <select class="form-select form-select-sm "
                                id="selectTipoContext"
                                wire:model="selectTipoContext"
                                data-allow-clear="true" data-control="select2"
                                data-placeholder="Seleciona o tipo de item">
                            <option></option>
                            <option value="1">Formatação de Video Iterno</option>
                            <option value="2">Formatação de Video Youtube</option>
                            <option value="3" selected>Formatação de Imagem Interna</option>
                            <option value="4">Formatação de Imagem Externa</option>
                        </select>
                        @error('auth')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="form-group mb-3">
                    <label class="">Contexto</label>
                    <textarea type="text"
                              class="form-control form-control-sm @error('auth') is-invalid @enderror "
                              wire:model.defer="sugestoes.conteudo" rows="4"
                              placeholder="Introduza o nome do autor"></textarea>
                    @error('auth')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">

                @if($selectTipoContext == 1)
                    <div class="col-12 col-sm-12 mt-5">
                        <div class="form-group mb-3">
                            <label class="required">Upload</label>
                            <input type="file"
                                   class="form-control form-control-sm @error('auth') is-invalid @enderror "
                                   wire:model.defer="file"
                                   placeholder="Introduza o nome do autor"/>
                            @error('auth')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @elseif($selectTipoContext == 2)
                    <div class="col-12 col-sm-12 mt-5">
                        <div class="form-group mb-3">
                            <label class="required">Upload</label>
                            <input type="text"
                                   class="form-control form-control-sm @error('auth') is-invalid @enderror "
                                   wire:model.defer="url"
                                   placeholder="introduza aqui a url"/>
                            @error('auth')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @elseif($selectTipoContext == 3)
                    <div class="col-12 col-sm-12 mt-5">
                        <div class="form-group mb-3">
                            <label class="required">Upload</label>
                            <input type="file"
                                   class="form-control form-control-sm @error('auth') is-invalid @enderror "
                                   wire:model.defer="file"
                                   placeholder="introduza aqui a url"/>
                            @error('auth')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @elseif($selectTipoContext == 4)
                    <div class="col-12 col-sm-12 mt-5">
                        <div class="form-group mb-3">
                            <label class="required">Upload</label>
                            <input type="text"
                                   class="form-control form-control-sm @error('auth') is-invalid @enderror "
                                   wire:model.defer="url"
                                   placeholder="introduza aqui a url"/>
                            @error('auth')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

            </div>

            <div class="col-12 col-sm-12">
                <div class="form-group mb-3 float-left">
                    <div class="col-sm input-group text-right  justify-content-end">
                        <button type="button" class="btn btn-light-primary btn-block btn-sm mr-2"
                                data-kt-menu-trigger="click" data-kt-menu-attach="parent" id="kt_drawer_chat_toggle"
                                data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom"
                                wire:click.prevent="openSegestoesView">
                            adicionar a sugestão da Blog
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Messenger-->
</div>
@push('scripts')
    <script>
        initRadio();

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('component.initialized', (component) => {
                initRadio();
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
                initRadio();
            })
        });

        function initRadio() {
            $(".radioInfor").attr("checked", false);

            $("#selectTipoContext").select2().on('change', () => {
                @this.
                set('selectTipoContext', $('#selectTipoContext').select2("val"))
            })
        }

        window.addEventListener('open-subview-modal', evt => {
            @this.
            set('classElement', "drawer drawer-end drawer-on")
        })


    </script>
@endpush
