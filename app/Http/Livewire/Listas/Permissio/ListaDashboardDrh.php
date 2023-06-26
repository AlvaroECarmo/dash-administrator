<?php

namespace App\Http\Livewire\Listas\Permissio;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\JustificacaoFaltas\GroupMember;
use App\Models\Traits\DashboadFunctions;
use App\Models\Traits\ListDelecte;
use App\Models\Traits\SearchUtilitarios;
use App\Models\Traits\StatusProject;

class ListaDashboardDrh extends PaginatedComponent
{
    use ListDelecte;
    use StatusProject;
    use SearchUtilitarios;

    protected $listeners = [
        'renderView' => 'listenerRender',
        'termoPesquisa' => 'updateTermoPesquisa',
        'rangeData' => 'rangeData'
    ];

    public function render()
    {
        $listaMembers = GroupMember::membrosDa('DashBoardDrh')
            ->dateBetween($this->initialDate, $this->finalDate)
            ->search($this->termoPesquisa)
            ->paginate(9);
        return view('livewire.listas.permissio.lista-dashboard-drh', [
            'listaMembers' => $listaMembers
        ]);
    }

    public function newMember()
    {

        $this->emit('executeViews', 'DashBoardDrh');
    }
}
