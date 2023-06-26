<?php

namespace App\Models\Traits;

trait DashboadFunctions
{
    public $arrayComponent = array();
    public $element = ['collapse' => '', 'classData' => 'fas fa-chevron-circle-left', 'id' => ''];
    public $dataFalta;

    public function openDetailsView($tarefa)
    {
        $this->emit('enviarJustificativos', $tarefa);
        $this->dispatchBrowserEvent('show-history', ['justificacao' => $tarefa]);
    }

    public function openDetails($idElement)
    {
        if ($this->element['id'] != $idElement)
            $this->element = ['collapse' => '', 'classData' => 'fas fa-chevron-circle-left', 'id' => ''];

        if ($this->element['collapse'] == '')
            $this->element = ['collapse' => 'show', 'classData' => 'fas fa-chevron-circle-down', 'id' => $idElement];
        else
            $this->element = ['collapse' => '', 'classData' => 'fas fa-chevron-circle-left', 'id' => ''];

        // $this->arrayComponent[$idElement] = $this->element;
        //dump($idElement);
    }

    public function actiction($tarefa, $type)
    {
        if ($type == 'aproved')
            $this->dispatchBrowserEvent('show-form-approve', ['justificacao' => $tarefa]);
        else if ($type == 'reject')
            $this->dispatchBrowserEvent('show-form-rejected', ['justificacao' => $tarefa]);
    }

    public function listenerRender()
    {
        $this->render();
    }

    public function dataSend($data)
    {
        $this->dataFalta = $data;
    }
}
