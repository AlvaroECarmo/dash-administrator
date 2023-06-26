<?php

namespace App\Http\Livewire\Forms\RodapeSite\GrupoParlamentar;

use Livewire\Component;
use App\Models\GetJSON;
class FormGrupoParlamentar extends Component
{

    use GetJSON;

    public $rodaPeSite;

    public function mount()
    {

        $this->rodaPeSite = $this->parseEncode('grupoparlamentar.json')['grupoparlamentar'];


    }


    public function render()
    {
        return view('livewire.forms.rodape-site.grupo-parlamentar.form-grupo-parlamentar');
    }
}
