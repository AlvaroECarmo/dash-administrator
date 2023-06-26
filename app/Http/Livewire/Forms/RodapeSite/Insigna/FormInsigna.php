<?php

namespace App\Http\Livewire\Forms\RodapeSite\Insigna;

use Livewire\Component;
use App\Models\GetJSON;
class FormInsigna extends Component
{

    use GetJSON;

    public $rodaPeSite;

    public function mount()
    {

        $this->rodaPeSite = $this->parseEncode('geririnsignia.json')['geririnsignia'];


    }


    public function render()
    {
        return view('livewire.forms.rodape-site.insigna.form-insigna');
    }
}
