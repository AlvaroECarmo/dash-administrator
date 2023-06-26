@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 callout callout-success">
                <div class="col-sm-6">
                    <h1>
                        Perfil do utilizador
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
                        <li class="breadcrumb-item active">Perfil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- /.col -->
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user shadow">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">
                            {{Auth::user()->name}}
                            <a href="{{route('logout')}}"><span class="right badge badge-warning ml-1">Alterar</span></a>
                        </h3>
                        @ifUsa_ldap
                            <h5 class="widget-user-desc">@if(Auth::user()->isAdmin()) Administrador @else Utilizador @endif</h5>
                        @else
                            <h5 class="widget-user-desc">@if(Auth::user()->hasRole('Administrador')) Administrador @else Técnico @endif</h5>
                        @endif
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{Auth::user()->getAvatarUrlAttribute()}}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Nome</h5>
                                    <span class="description-text">{{Auth::user()->name}}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Login</h5>
                                    <span class="description-text">{{Auth::user()->email}}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">Palavra passe</h5>
                                    <span class="description-text">*******</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
    </div>
        <!-- /.col -->
@endsection

@section('third_party_scripts')
<script>
    $(document).ready( function(){
        toastr.options = {
            "positionClass": "toast-bottom-right",
            "progressBar": true,
        }

        window.addEventListener('mostra-erro', event=> {
            toastr.error(event.detail.message,'Erro');
        });

        window.addEventListener('hide-form', event => {
            $('#formUser').modal('hide');

            toastr.success(event.detail.message,'Sucesso');
        });

        window.addEventListener('show-form', event => {
            $('#formUser').modal('show');
        });

        window.addEventListener('show-delete-form', event=>{
            $('#formConfirmation').modal('show');
        });
        window.addEventListener('hide-delete-form', event=>{
            $('#formConfirmation').modal('hide');
            if (event.detail.error === true) {
                toastr.error(event.detail.message, 'Erro');
            } else {
                toastr.success(event.detail.message, 'Sucesso');
            }
        });
    });

</script>
@endsection
