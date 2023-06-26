<?php

namespace App\Http\Livewire\Comuns;

use App\Models\JustificacaoFaltas\GroupMember;
use App\Models\JustificacaoFaltas\OutInOffice;
use Livewire\Component;

class ActionDeleteOutOfOfficePermission extends Action
{

    protected $listeners = ['eliminarClick' => 'openView'];

    public function mount()
    {
        $this->modalId = 'removeAutoOffice';
        $this->title = 'Remover o Out Office';
        $this->cardColor = 'card-danger';

        $this->actioButton = '<button type="button" class="btn btn-danger"'
            . 'wire:click.prevent="remover">'
            . '<i class="fa fa-check mr-1"></i> Remover'
            . '</button>';

        $this->loadVews = false;
    }

    public function remover()
    {
        OutInOffice::find($this->obj['id'])->delete();
        $this->dispatchBrowserEvent('closeremoveAutoOffice', ['message' => config('Departments.ActionDelete')]);
        $this->emit('renderView');
    }

    public function openView($data)
    {
        $this->obj = $data;
        $this->dispatchBrowserEvent('show-eliminar');
    }
}
