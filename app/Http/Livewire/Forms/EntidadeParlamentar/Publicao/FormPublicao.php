<?php

namespace App\Http\Livewire\Forms\EntidadeParlamentar\Publicao;

use Livewire\Component;
use App\Models\GetJSON;
class FormPublicao extends Component
{

    use GetJSON;

    public $entidadeParlamentar;

    public function mount()
    {

        $this->entidadeParlamentar = $this->parseEncode('gerirpublicacoes.json')['gerirpublicacoes'];


    }

    public function render()
    {
        return view('livewire.forms.entidade-parlamentar.publicao.form-publicao');
    }
}
