<?php

namespace App\Http\Livewire\Comuns;

use App\Models\External\PRIMAVERA\Funcionario;
use Livewire\Component;

class DeputyCounts extends Component
{
    public function render()
    {
        return view('livewire.comuns.deputy-counts', [
            'counts' => Funcionario::where('CodEstabelecimento', config('cian.ESTABELECIMENTO_DEPUTADOS'))
                ->where('Situacao', config('cian.SITUACAO_ACTIVO'))->count()
        ]);
    }
}
