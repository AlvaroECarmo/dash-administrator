<?php

namespace App\Http\Livewire\Comuns;

use Livewire\Component;

class FooScripts extends Component
{
    public $idNameModel;

    public function mount($idNameModel)
    {
        $this->idNameModel = $idNameModel;
    }

    public function render()
    {
        return view('livewire.comuns.foo-scripts');
    }
}
