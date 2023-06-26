<?php

namespace App\Http\Livewire\Comuns;

use App\Models\External\IDONIC\AsAusencia;
use App\Models\External\IDONIC\Pessoa;
use App\Models\JustificacaoFaltas\LinhaJustificacaoFaltaAusenciaID;
use App\Models\JustificacaoFaltas\JustificacaoFalta;
use App\Models\JustificacaoFaltas\WorkList;

class ActionConfirmedRejectDrh extends ActionConfirmed
{
    public function mount()
    {
        $this->init();
    }

    public function rejected()
    {

        $linhas = LinhaJustificacaoFaltaAusenciaID::where('justificacaofalta_id', $this->justificacao['id'])->get('asAusencia_id')->toArray();

        $manger = Pessoa::whereEmail(\Auth::user()->ldap->getEmail())->first()->toArray();

        if ($manger) {
            $idManger = $manger['ID'];
        } else {
            $idManger = \Auth::user()->id;
        }

        AsAusencia::rejeicaoASAusencias($linhas, $idManger);
        $justificacao = JustificacaoFalta::find($this->justificacao['id']);
        $justificacao->updateObservacoes($this->observacoes, '[ Rejeitado DRH ] - ');
        $justificacao->update(['estado' => 2]);
        WorkList::where('justificacaofalta_id', $this->justificacao['id'])->delete();
        $this->reset();
        $this->init();

        $this->dispatchBrowserEvent('close-form', ['message' => config('Departments.ActionRejected')]);
    }

    public function init()
    {
        $this->modalId = 'rejeitarJustificacao';
        $this->title = 'Rejeitar a justificação de falta';
        $this->cardColor = 'card-danger';
        $this->actioButton = '<button type="button" class="btn btn-danger"'
            . 'wire:click.prevent="rejected">'
            . '<i class="fa fa-check mr-1"></i> Rejeirar'
            . '</button>';

        $this->loadVews = false;
    }
}
