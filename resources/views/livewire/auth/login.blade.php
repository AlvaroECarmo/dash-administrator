<div class="d-flex flex-column flex-lg-row-fluid py-10 order-1  order-lg-2">
    <div class="d-flex flex-center flex-column flex-column-fluid">

        <div class="w-100 w-sm-450px w-lg-500px p-10 p-lg-20 mx-auto">

            <form class="form w-100 @if($cont >= 3) d-none @endif"
                  novalidate="novalidate" wire:submit.prevent="loginUser"
                  id="kt_sign_in_form"
                  action="#">
                <div class="text-center mb-10">
                    <img src="{{ asset('assets/icons/apple-touch-icon-76x76.png') }}" alt="">

                </div>


                <!--begin::Alert-->
                @if( session()->has('error'))
                    <div class="alert alert-danger">
                        <div class="d-flex flex-column">
                            <!--begin::Title-->

                            <h6 class="mb-1 text-dark">Login invalido</h6>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <span data-bs-dismiss="alert" class="cursor-pointer text-hover-danger">Verifique as informação de login se estão certas.</span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                @endif
                <!--end::Alert-->
                <div class="fv-row mb-5">
                    @if(!$closeContent)
                        <label class="required">Utilizador</label>
                    @else
                        <label class="required">Email</label>
                    @endif
                    <input
                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                        @if(!$closeContent)
                            placeholder="Introduza aqui Utlizador"
                        @else
                            placeholder="Introduza aqui o seu email"
                        @endif
                        wire:model.lazy="email" type="text"
                        autocomplete="off"/>
                </div>
                @if(!$closeContent)

                    <div class="fv-row mb-0">

                        <div class="d-flex flex-stack mb-2 justify-content-between">
                            <label class="form-label text-dark fs-6  required">Senha</label>

                        </div>

                        <input
                            class="form-control form-control-sm @error('password') is-invalid @enderror"
                            wire:model.lazy="password" @if(!$mostrarSenha) type="password" @else type="text" @endif
                            placeholder="Introduza aqui a Senha"
                            name="password" autocomplete="off"/>

                        <div class="fv-row text-end mt-2">
                            <a href="#" wire:click.prevent="reportarEmail"
                               class="text-sm text-decoration-underline">
                                Esqueci a minha senha!
                            </a>
                        </div>
                        <br>
                        <div class="fv-row text-center mt-2">

                            <a href="#" wire:click.prevent="passwordEyes" class="text-decoration-underline"><i
                                    class="fa @if(!$mostrarSenha) fa-eye @else  fa-eye-slash @endif  text-info"></i>&nbsp;
                                @if(!$mostrarSenha)
                                    Mostrar a senha
                                @else
                                    Ocultar a senha
                                @endif

                            </a>
                        </div>

                    </div>

                @else
                    <div class="fv-row mb-2 justify-content-end text-end">

                        <a href="#" wire:click.prevent="reportarEmail">Voltar para o login</a>
                    </div>
                @endif

                <div class="text-center row p-4">
                    <!--begin::Submit button-->
                    @if(!$closeContent)
                        <button type="button" class="btn btn-sm btn-warning col text-uppercase"
                                wire:click.prevent="redirectPortal">
                            <span class="indicator-label" wire:loading.remove>Portal</span>
                            <span disabled wire:loading wire:target="redirectPortal">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        &nbsp;&nbsp;

                        <button type="submit" id="kt_sign_in_submit" wire:click.prevent="loginUser"
                                class="btn btn-sm btn-outline-info border  col text-uppercase">
                            <span class="indicator-label" wire:loading.remove
                                  wire:target="loginUser">Entrar</span>
                            <span disabled wire:loading wire:target="loginUser">Aguarde...
							    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    @else
                        <button type="button" id="kt_sign_in_submit" wire:click.prevent="enviarEmailLogi"
                                class="btn btn-sm btn-outline-info border  col text-uppercase">
                            <span class="indicator-label" wire:loading.remove wire:target="enviarEmailLogi">Enviar o pedido ..</span>
                            <span disabled wire:loading wire:target="enviarEmailLogi">Por favor espere...
								 <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    @endif


                </div>

            </form>
            @if($cont >= 3)
                <div class="text-center mb-10">
                    <span><img src="{{ asset('assets/android-chrome-maskable-512x512@2x.png') }}" alt=""></span>
                    <h1 class="text-dark mb-3 text-uppercase">Assembleia nacional de Angola </h1>
                    <p>
                        Várias tentativas erradas.
                        Por falor contacta o administrador do sitema
                        <a href="https://parlamento.ao">Entra no site</a>
                    </p>
                    <p>
                        {{ \Request::ip()  }}
                    </p>
                </div>
            @endif
        </div>


    </div>

    <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0 text-uppercase">
        <div class="d-flex flex-center fw-bold fs-6">
            <a href="#" class="text-muted text-hover-primary px-2"
               target="_blank">Programador</a>
            <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Entidades</a>
            <a href="#"
               class="text-muted text-hover-primary px-2" target="_blank">CIAN 2022</a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('sucessEmail', evt => {
            toastr.info('O seu pedido para restaurar a senha foi enviado com sucesso!');
        })
    </script>
@endpush


