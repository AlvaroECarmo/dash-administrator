<?php

namespace App\Http\Livewire\Permissoes;

use App\Models\Traits\DashboadFunctions;
use App\Models\Traits\SearchUtilitarios;
use App\Models\Traits\StatusProject;
use Livewire\Component;

class PermissoesGroup extends Component
{
    use SearchUtilitarios;
    use StatusProject;
    use DashboadFunctions;

    public $funcionario;

    public function mount()
    {
        $this->tab1 = 'active';
    }

    public function render()
    {
        return view('livewire.permissoes.permissoes-group');
    }

    public function updatedFuncionario()
    {
        $this->emit('funcionarioID', $this->funcionario);
    }
}
