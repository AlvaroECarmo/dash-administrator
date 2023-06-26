<?php

namespace App\Http\Livewire\Forms\Cabecalho\MenuPrincipal;

use App\Models\Parlamento\Mainmenu;
use Livewire\Component;

class MenuSubForm extends Component
{
    public $parent;
    public $data = array();

    public function mount(Mainmenu $parent = null)
    {

        $this->parent = $parent;
    }

    public function render()
    {
        return view('livewire.forms.cabecalho.menu-principal.menu-sub-form');
    }

    public function saveElement()
    {
        if ($this->data['classificacao'] == "/") {
            $this->data['url'] = "/" . $this->data['url'];
        }

        $this->data['elements'] = $this->parent->id;

        Mainmenu::create($this->data);
        $this->dispatchBrowserEvent('send-success', ['message' => 'O sub item do menu foi cadastrado com sucesso!']);

    }


}
