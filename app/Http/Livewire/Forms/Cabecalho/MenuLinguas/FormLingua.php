<?php

namespace App\Http\Livewire\Forms\Cabecalho\MenuLinguas;

use App\Models\Parlamento\Headercontent;
use App\Models\Parlamento\Mainheader;
use App\Models\Parlamento\TaskActivities;
use Livewire\Component;
use App\Models\GetJSON;

class FormLingua extends Component

{
    public $data = ['id' => 0];

    use GetJSON;

    public $cabecalho;
    public $select_header = array();

    protected $listeners = ['sendData'];


    public function mount()
    {
        $this->select_header = Mainheader::latest()->get();
        $this->cabecalho = $this->parseEncode('gerirLinguas.json')['gerirLinguas'];

    }

    public function render()
    {
        return view('livewire.forms.cabecalho.menu-linguas.form-lingua');
    }


    public function saveInfo()
    {
        $this->data['user_id'] = \Auth::user()->id;

        if ($this->data['id'] > 0) {
            Headercontent::find($this->data['id'])
                ->update($this->data);

            TaskActivities::createdActivity(
                $this->data,
                "Livewire.Forms.Cabecalho.FormLingua",
                TaskActivities::UPDATE, "Actualizado a Lingua da Pagina"
            );


            $this->data = array();
            $this->dispatchBrowserEvent('init-component');
            $this->dispatchBrowserEvent('send-success', ['message' => 'Dados da lingua actulizado com sucesso!']);
        } else {
            $element = Headercontent::create($this->data);

            TaskActivities::createdActivity(
                $element->toArray(),
                "Livewire.Forms.Cabecalho.FormLingua",
                TaskActivities::CREATE, "Criado a lingua da Pagina"
            );

            $this->data = array();
            $this->dispatchBrowserEvent('init-component');
            $this->dispatchBrowserEvent('send-success', ['message' => 'Dados da lingua criado com sucesso!']);
        }

        // Modelo
        $this->emit('refreshPage');

    }

    public function sendData($attribute)
    {
        $this->data = $attribute;
    }

    public function updated()
    {

        //$this->dispatchBrowserEvent('init-component');
    }
}
