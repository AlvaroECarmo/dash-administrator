<?php

namespace App\Http\Livewire\Comuns;

use Livewire\Component;

class Header extends Component
{
    public $title;
    public $context;

    public function mount($title = 'Gestão de utilizadores', $context = 'utilizadores')
    {
        $this->title = $title;
        $this->context = $context;
    }

    public function render()
    {
        return view('livewire.comuns.header');
    }
}
