<?php

namespace App\Http\Livewire\Comuns;

use App\Models\JustificacaoFaltas\JustificacaoFalta;
use App\Models\JustificacaoFaltas\LinhaJustificacaoFalta;
use App\Models\JustificacaoFaltas\LinhaJustificacaoFaltaAusenciaID;
use App\Models\JustificacaoFaltas\WorkList;

class ActionDeleteWorkList extends Action
{

    protected $listeners = ['eliminarClick' => 'openView'];

    public function mount()
    {
        $this->modalId = 'removerworkflow';
        $this->title = 'Eliminar O Fluxo de trabalho seleccionado';
        $this->cardColor = 'card-danger';

        $this->actioButton = '<button type="button" class="btn btn-danger"'
            . 'wire:click.prevent="remover">'
            . '<i class="fa fa-check mr-1"></i> Eliminar'
            . '</button>';

        $this->loadVews = false;
    }

    public function remover()
    {
        try {
            WorkList::where('id', $this->obj['id'])->delete();
            JustificacaoFalta::where('id', $this->obj['justificacaofalta_id'])->delete();
            LinhaJustificacaoFalta::where('justificacaofalta_id', $this->obj['justificacaofalta_id'])->delete();
            LinhaJustificacaoFaltaAusenciaID::where('justificacaofalta_id', $this->obj['justificacaofalta_id'])->delete();

            $this->dispatchBrowserEvent('closeremoverworkflow', ['message' => config('Departments.ActionDelete')]);
            $this->emit('subformIsClosed');
        } catch (\Exception $ed) {

        }

    }

    public function openView($data)
    {
        $this->obj = $data;
        $this->dispatchBrowserEvent('show-eliminar');
    }
}
