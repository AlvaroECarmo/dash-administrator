<?php

namespace App\Http\Livewire\Listas\Configuracoes;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\JustificacaoFaltas\WorkList;
use App\Models\Traits\DashboadFunctions;
use App\Models\Traits\SearchUtilitarios;
use App\Models\Traits\StatusProject;

class ListaWorklist extends PaginatedComponent
{
    use SearchUtilitarios;
    use StatusProject;
    use DashboadFunctions;

    protected $listeners = ['subformIsClosed' => 'updateView', 'termoPesquisa' => 'updateTermoPesquisa', 'reseting', 'reseting', 'rangeData' => 'rangeData'];

    public function render()
    {
        $work = WorkList::search($this->termoPesquisa)
            ->dateBetween($this->initialDate, $this->finalDate)
            ->paginate(9);
        return view('livewire.listas.Configuracoes.lista-worklist', [
            'worklist' => $work
        ]);
    }

    public function deleteWorkList($data)
    {
        $this->emit('eliminarClick', $data);
    }
}
