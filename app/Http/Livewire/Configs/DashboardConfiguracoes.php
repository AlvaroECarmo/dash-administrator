<?php

namespace App\Http\Livewire\Configs;

use App\Models\Traits\DashboadFunctions;
use App\Models\Traits\SearchUtilitarios;
use App\Models\Traits\StatusProject;
use Livewire\Component;

class DashboardConfiguracoes extends Component
{
    use SearchUtilitarios;
    use StatusProject;
    use DashboadFunctions;

    public $funcionario;

    public function mount()
    {
        $this->tab1 = 'active';
    }


    public function updatedFuncionario()
    {
        $this->emit('funcionarioID', $this->funcionario);
    }

    public function render()
    {
        return view('livewire.configs.dashboard-configuracoes');
    }
}