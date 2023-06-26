<div class="">
    <a class="nav-link btn btn-secondary btn-sm" data-widget="navbar-search"
       data-target="#navbar-search3"
       href="#" wire:click.prevent="openSearch"
       role="button">
        <i class="fas fa-search "></i>
    </a>
    <div class="navbar-search-block {{ $openSearch }} mt-2 mt-sm-0 p-0" id="navbar-search3">

        <div class="input-group input-group mt-0">
            <input class="form-control form-control-navbar " type="search" placeholder="Termo de pesquisa"
                   wire:model.debounce.500ms="termoPesquisaForm"
                   style="height: 41px"
                   aria-label="Search">
            <div class="input-group-append bg-secondary" style=" border-radius: 5px 5px 5px 5px">
                <button class="btn btn-navbar btn-sm btn-secondary" type="button"
                        data-widget="navbar-search" style="width: 60px;"
                        wire:click.prevent="closeSearch"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</div>
