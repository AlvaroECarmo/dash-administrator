<div>
    @if (session()->has('pesquisaError'))
        <div class="alert alert-info alert-dismissible mb-1">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-info"></i>
            {{ session('pesquisaError') }}
        </div>
    @endif

</div>
