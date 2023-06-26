<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

abstract class Widget extends Component
{
    public $titulo;
    public $contagem;
    public $icon;
    public $url;
    public $textoUrl;

    public function render()
    {
        return view('livewire.dashboard.widget');
    }

    abstract public function atualizaContagem();
}
