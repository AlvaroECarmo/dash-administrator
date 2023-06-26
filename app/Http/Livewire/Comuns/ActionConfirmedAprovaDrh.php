<?php

namespace App\Http\Livewire\Comuns;

use App\Models\External\IDONIC\AsAusencia;
use App\Models\External\IDONIC\AsResultado;
use App\Models\External\IDONIC\Pessoa;
use App\Models\JustificacaoFaltas\JustificacaoFalta;
use App\Models\JustificacaoFaltas\LinhaJustificacaoFaltaAusenciaID;
use App\Models\JustificacaoFaltas\WorkList;


class ActionConfirmedAprovaDrh extends ActionConfirmed
{

    public function mount()
    {
        $this->init();
    }

    public function approved()
    {
        $linhas = LinhaJustificacaoFaltaAusenciaID::where('justificacaofalta_id', $this->justificacao['id'])->get('asAusencia_id')->toArray();

        $manger = Pessoa::whereEmail(\Auth::user()->ldap->getEmail())->first()->toArray();

        if ($manger) {
            $idManger = $manger['ID'];
        } else {
            $idManger = \Auth::user()->id;
        }

        AsAusencia::aprovacaoASAusencias($linhas, $idManger);
        $jstf = JustificacaoFalta::find($this->justificacao['id']);
        $jstf->updateObservacoes($this->observacoes, '[ Aprovado DRH ] - ');
        $jstf->update(['estado' => 1]);
        AsResultado::updateAsResultados($jstf);
        WorkList::where('justificacaofalta_id', $this->justificacao['id'])->delete();
        $this->reset();
        $this->init();

        $this->dispatchBrowserEvent('close-form', ['message' => config('Departments.ActionAproved')]);
    }

    public function init()
    {
        $this->modalId = 'aprovaJustificacao';
        $this->title = 'Aprovar a justificação de falta';
        $this->actioButton = '<button type="button" class="btn btn-primary"'
            . 'wire:click.prevent="approved">'
            . '<i class="fa fa-check mr-1"></i> Aprovar'
            . '</button>';

        $this->loadVews = false;
    }
}
