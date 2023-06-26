@extends('layouts.app')

@section('content')
    @livewire('comuns.header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        {{-- COMPONENTE DE LISTAGEM E GESTÃO DE UTILIZADORES --}}
                        @livewire('listas.users.user-list')
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@livewire('comuns.foo-scripts',['idNameModel'=>'#formConfirmation'])
@livewire('comuns.foo-scripts',['idNameModel'=>'#formUser'])
