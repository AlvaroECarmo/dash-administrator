<?php

namespace App\Http\Livewire\Comuns;

use App\Models\JustificacaoFaltas\GroupMember;
use Livewire\Component;

class ActionDeleteUserPermission extends Action
{

    protected $listeners = ['eliminarClick' => 'openView'];

    public function mount()
    {
        $this->modalId = 'removerfuncionario';
        $this->title = 'Eliminar o funcionário das permissões da DRH';
        $this->cardColor = 'card-danger';

        $this->actioButton = '<button type="button" class="btn btn-danger"'
            . 'wire:click.prevent="remover">'
            . '<i class="fa fa-check mr-1"></i> Eliminar'
            . '</button>';

        $this->loadVews = false;
    }

    public function remover()
    {
        GroupMember::find($this->obj['id'])->delete();
        $this->dispatchBrowserEvent('closeremoverfuncionario',['message' => config('Departments.ActionDelete')]);
        $this->emit('renderView');
    }

    public function openView($data)
    {
        $this->obj = $data;
        $this->dispatchBrowserEvent('show-eliminar');
    }
}
