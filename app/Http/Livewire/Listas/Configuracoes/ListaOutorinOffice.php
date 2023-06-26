<?php

namespace App\Http\Livewire\Listas\Configuracoes;

use App\Models\JustificacaoFaltas\OutInOffice;
use Livewire\Component;

class ListaOutorinOffice extends Component
{

    protected $listeners = ['renderView' => 'renderView'];

    public function render()
    {
        $outInOfOffice = OutInOffice::paginate(9);

        return view('livewire.listas.Configuracoes.lista-outorin-office', [
            'outInOfOffice' => $outInOfOffice
        ]);
    }

    public function anularOutOffe(OutInOffice $dados)
    {
        $this->emit('eliminarClick', $dados);

    }

    public function renderView()
    {
        $this->render();
    }
}
