<?php

namespace App\Http\Livewire\Comuns;

use Livewire\Component;

class Action extends Component
{
    public $loadVews;
    public $modalId;
    public $cardColor;
    public $actioButton;
    public $title;
    public $obj;

    public function render()
    {
        return view('livewire.comuns.action');
    }

    public function closing(){
        $this->dispatchBrowserEvent('closeModal');
    }
}
