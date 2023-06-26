<?php

namespace App\Http\Livewire\Listas\Permissio;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\JustificacaoFaltas\GroupMember;
use App\Models\Traits\ListDelecte;

class ListaDashboardManager extends PaginatedComponent
{
    use ListDelecte;
    protected $listeners = ['renderView' => 'listenerRender'];

    public function render()
    {
        $listaMembers = GroupMember::membrosDa('DashBoardManager')->paginate(9);
        return view('livewire.listas.permissio.lista-dashboard-manager', [
            'listaMembers' => $listaMembers
        ]);
    }

    public function newMember()
    {
        $this->emit('executeViews', 'DashBoardManager');
    }
}
