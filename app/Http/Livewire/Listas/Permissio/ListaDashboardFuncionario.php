<?php

namespace App\Http\Livewire\Listas\Permissio;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Comuns\GroupMember;use App\Models\Traits\ListDelecte;

class ListaDashboardFuncionario extends PaginatedComponent
{
    use ListDelecte;

    protected $listeners = ['renderView' => 'listenerRender'];



    public function render()
    {

        $listaMembers = GroupMember::membrosDa('DashBoardFuncionario')->paginate(9);

        return view('livewire.listas.permissio.lista-dashboard-funcionario', [
            'listaMembers' => $listaMembers
        ]);
    }


    public function newMember()
    {
        // $this->dispatchBrowserEvent('show-form', ['data' => 'DashBoardFuncionario']);
        $this->emit('executeViews', 'DashBoardFuncionario');
    }
}
