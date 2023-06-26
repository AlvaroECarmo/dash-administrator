<?php

namespace App\Http\Livewire\Comuns;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\JustificacaoFaltas\JustificacaoFalta;
use App\Models\Traits\DashboadFunctions;
use App\Models\Traits\StatusProject;

class HistoryJustificacao extends PaginatedComponent
{
    use StatusProject;
    use DashboadFunctions;

    public $open = false;
    public $justificao = 0;
    public $tarefas = ['designacaoCodigoJustificacao' => '', 'observacoes' => '', 'pessoaNome' => ''];
    protected $listeners = ['enviarJustificativos' => 'updataJustificacao'];
    public $anexos = array();

    public function updataJustificacao($justificacao)
    {
        $this->justificao = $justificacao;
    }

    public function render()
    {
        $justificacao = JustificacaoFalta::seleccionadJustificacao($this->justificao, true)
            ->first();

        if ($justificacao) {
            $tarefe = $justificacao->linhasFaltasOnTask();
            $this->tarefas = $justificacao;
            $this->anexos = $justificacao->anexos;

        } else {
            $tarefe = array();
        }


        return view('livewire.comuns.history-justificacao', [
            'semana' => $this->diaSemanais,
            'statusList' => $this->statusList,
            'tarefe' => $tarefe
        ]);
    }

    public function closeHistory()
    {
        $this->open = false;
    }

}
