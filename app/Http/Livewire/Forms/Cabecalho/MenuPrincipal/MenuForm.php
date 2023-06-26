<?php

namespace App\Http\Livewire\Forms\Cabecalho\MenuPrincipal;

use App\Models\GetJSON;
use App\Models\Parlamento\Mainmenu;
use App\Models\Parlamento\TaskActivities;
use Illuminate\Support\Fluent;
use Livewire\Component;

class MenuForm extends Component
{
    use GetJSON;

    public $cabecalho;
    protected $listeners = ['sendMainMenu'];

    public $data = ['id' => 0, 'context' => null, 'url' => null];

    public function mount()
    {
        $this->cabecalho = $this->parseEncode('gerirmenuprincipal.json')['gerirmenuprincipal'];
        $this->dispatchBrowserEvent('init-component');
    }

    public function render()
    {
        $mainMenu = Mainmenu::all();
        return view('livewire.forms.cabecalho.menu-principal.menu-form', ['mainMenu' => $mainMenu]);
    }

    public function sendMainMenu($element)
    {
        $this->data = $element;

    }

    public function save_header()
    {

        if ($this->data['id'] > 0) {
            Mainmenu::find($this->data['id'])->update($this->data);
            $this->dispatchBrowserEvent('send-success', ['message' => 'Registo actualizado com sucesso']);
            TaskActivities::create([
                'primavera_email' => auth()->user()->ldap->getEmail(),
                'data_tool_info' => json_encode($this->data, JSON_THROW_ON_ERROR | true),
                'action_info' => 'Atualizado o Menu da Pagina ' . auth()->user()->ldap->getDisplayName(),
                'seccion_info' => 'Updated',
                'user_id' => auth()->user()->id,
                'task_identity' => $this->data['id'],
                'class_name' => "Livewire.Forms.Cabecalho.MenuForm"
            ]);
        } else {
            Mainmenu::create($this->data);
            TaskActivities::create([
                'primavera_email' => auth()->user()->ldap->getEmail()??'administrator@parlamento.ao',
                'data_tool_info' => json_encode($this->data, true),
                'action_info' => 'Criado o Menu da Pagina ' . auth()->user()->ldap->getDisplayName(),
                'seccion_info' => 'Created',
                'user_id' => auth()->user()->id,
                'task_identity' => $this->data['id'],
                'class_name' => "Livewire.Forms.Cabecalho.MenuForm"
            ]);
            $this->dispatchBrowserEvent('send-success', ['message' => 'Registo inserido com sucesso']);
        }

        $this->emit('updatedOne');
        $this->initComponent();
    }

    public function initComponent()
    {
        $this->data = ['id' => 0];
    }

    public function updatedDataContext()
    {
        $elems = new Fluent($this->data);

        if (!$elems->url) {
            $this->data['url'] = strtoupper(date('YmdHis') . str_replace(' ', '-', $this->data['context']) . csrf_token());
        }


    }
}
