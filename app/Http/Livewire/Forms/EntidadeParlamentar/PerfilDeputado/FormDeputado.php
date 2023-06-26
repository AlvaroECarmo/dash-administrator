<?php

namespace App\Http\Livewire\Forms\EntidadeParlamentar\PerfilDeputado;

use Livewire\Component;
use App\Models\GetJSON;
class FormDeputado extends Component
{

    use GetJSON;

    public $entidadeParlamentar;

    public function mount()
    {

        $this->entidadeParlamentar = $this->parseEncode('perfildodeputado.json')['perfildodeputado'];


    }

    public function render()
    {
        return view('livewire.forms.entidade-parlamentar.perfil-deputado.form-deputado');
    }
}
