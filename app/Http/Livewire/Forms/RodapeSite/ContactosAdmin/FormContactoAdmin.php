<?php

namespace App\Http\Livewire\Forms\RodapeSite\ContactosAdmin;

use Livewire\Component;
use App\Models\GetJSON;
class FormContactoAdmin extends Component
{
    use GetJSON;

    public $rodaPeSite;

    public function mount()
    {

        $this->rodaPeSite = $this->parseEncode('contactoadministrativos.json')['contactoadministrativos'];


    }

    public function render()
    {
        return view('livewire.forms.rodape-site.contactos-admin.form-contacto-admin');
    }
}
