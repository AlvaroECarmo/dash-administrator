<?php

namespace App\Http\Livewire\Forms\RodapeSite\CentralInformacao;
use App\Models\GetJSON;
use Livewire\Component;

class FormCentralInformacao extends Component
{

    use GetJSON;

    public $rodaPeSite;

    public function mount()
    {

        $this->rodaPeSite = $this->parseEncode('centralinformacoes.json')['centralinformacoes'];


    }

    public function render()
    {
        return view('livewire.forms.rodape-site.central-informacao.form-central-informacao');
    }
}
