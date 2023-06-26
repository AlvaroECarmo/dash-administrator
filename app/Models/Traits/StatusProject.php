<?php

namespace App\Models\Traits;

use App\Models\External\IDONIC\AsResultado;
use App\Models\JustificacaoFaltas\LinhaJustificacaoFalta;

trait StatusProject
{


    public $tab1;
    public $tab2;
    public $tab3;

    public $initialDate;
    public $finalDate;

    protected $faltasPorJustificar;
    protected $faltasEmProcessamento;
    public $observacaoOpen = true;
    public $loader = true;

    protected $diaSemanais = [
        'Sunday' => 'Domingo',
        'Monday' => 'Segunda',
        'Tuesday' => 'Terça',
        'Wednesday' => 'Quarta',
        'Thursday' => 'Quinta',
        'Friday' => 'Sexta',
        'Saturday' => 'Sabado',
    ];

    protected $stadoJustificacao = [
        '1' => ['text' => 'Justificação da falta aprovado', 'count' => '80%', 'color' => 'bg-success'],
        '2' => ['text' => 'Justificação da falta rejeitado', 'count' => '50%', 'color' => 'bg-danger'],
    ];

    protected $statusList = [
        '-1' => ['text' => 'Indefinido', 'count' => '40%', 'color' => 'bg-primary'],
        '0' => ['text' => 'Parcial', 'count' => '50%', 'color' => 'bg-primary'],
        '1' => ['text' => 'Folga', 'count' => '80%', 'color' => 'bg-warning'],
        '2' => ['text' => 'Feriado', 'count' => '86%', 'color' => 'bg-red'],
        '4' => ['text' => 'Dia completo', 'count' => '98%', 'color' => 'bg-red'],
        '5' => ['text' => 'Dia completo', 'count' => '10%', 'color' => 'bg-red'],
    ];

    public $funcionario;

    public $year = "";


    public function listener($listener): string
    {

        switch ($listener) {

            case 'FaltasInjustificadas':
                $this->resetTab();
                return $this->tab1 = 'active';
            case 'FaltasEmProcessamento':
                $this->resetTab();
                return $this->tab2 = 'active';

            case 'FaltasProcessadas':
                $this->resetTab();
                return $this->tab3 = 'active';

        }


        return "";
    }

    private function resetTab()
    {
        $this->tab1 = '';
        $this->tab2 = '';
        $this->tab3 = '';
    }

    public function updateView()
    {
        $this->render();
    }


    public function rangeData($dateRange)
    {
        try {
            $this->initialDate = \Date::parse($dateRange['initialDate']);
            $this->finalDate = \Date::parse($dateRange['finalDate']);
        } catch (\Exception $d) {

        }
    }

    public function reseting()
    {
        $this->initialDate = null;
        $this->finalDate = null;
    }

    public function updateTermoPesquisa($termo)
    {
        $this->termoPesquisa = ($termo['termoPesquisaForm']);
    }


    public function closeObservacao()
    {
        $this->observacaoOpen = false;
    }



}
