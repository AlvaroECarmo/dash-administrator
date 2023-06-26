<?php

namespace App\Http\Livewire\Comuns;

use Livewire\Component;

class ActionConfirmed extends Component
{
    public $loadVews = true;
    public $cardColor;
    public $title;
    public $modalId;
    public $justificacao = ['pessoaNome' => ''];
    public $actioButton;
    public $observacoes;


    public function render()
    {
        return view('livewire.comuns.action-confirmed');
    }
}
