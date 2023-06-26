<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 callout callout-success">
                <div class="col-sm-6">
                    <h1>
                        {{ $title?:'Gestão de utilizadores' }}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
                        <li class="breadcrumb-item active">{{ $context?:'utilizadores' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
