<?php

namespace App\Http\Livewire\Comuns;

use App\Models\External\IDONIC\AsAusencia;
use App\Models\External\IDONIC\Pessoa;
use App\Models\JustificacaoFaltas\JustificacaoFalta;
use App\Models\JustificacaoFaltas\LinhaJustificacaoFaltaAusenciaID;
use App\Models\JustificacaoFaltas\WorkList;
use PHPUnit\Exception;


class ActionConfirmedAprova extends ActionConfirmed
{

    public function mount()
    {
        $this->init();
    }

    public function approved()
    {
        try {
            $linhas = LinhaJustificacaoFaltaAusenciaID::where('justificacaofalta_id', $this->justificacao['id'])->get('asAusencia_id')->toArray();

            $manger = Pessoa::whereEmail(\Auth::user()->ldap->getEmail())->first()->toArray();

            if ($manger) {
                $idManger = $manger['ID'];
            } else {
                $idManger = \Auth::user()->id;
            }

            AsAusencia::aprovacaoASAusencias($linhas, $idManger);
            JustificacaoFalta::find($this->justificacao['id'])->updateObservacoes($this->observacoes, '[ Aprovado Manager] - ');

            WorkList::where('justificacaofalta_id', $this->justificacao['id'])->update(['isDrh' => true]);
            $this->reset();
            $this->init();
        } catch (\Exception $e) {

        }

        $this->dispatchBrowserEvent('close-formManager', ['message' => config('Departments.ActionAproved')]);

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
