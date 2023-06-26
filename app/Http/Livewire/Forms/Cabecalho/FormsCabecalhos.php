<?php

namespace App\Http\Livewire\Forms\Cabecalho;

use App\Http\Controllers\API\MainmenuAPIController;
use App\Models\Parlamento\Mainheader;
use App\Models\Parlamento\Mainmenu;
use App\Models\Parlamento\TaskActivities;
use Dflydev\DotAccessData\Data;
use Livewire\Component;
use App\Models\GetJSON;

class FormsCabecalhos extends Component
{
    use GetJSON;

    public $data = [
        'id' => '',
        'status' => false,
        'date_region' => 'Assembleia Nacional'
    ];
    public $icon_region;

    protected $listeners = ['sendMainHeader'];

    public function sendMainHeader($element)
    {
        $this->data = $element;
        $this->icon_region = $element['icon_region'];
        $this->dispatchBrowserEvent('init-Component');
    }


    public $cabecalho;

    public function mount()
    {
       /// $this->data['date_region'] = date_format(\Date::now(), 'h:i.s \o\n l jS F Y');
        $this->cabecalho = $this->parseEncode('gerircabecalho.json')['gerircabecalho'];

    }

    public function render()
    {
        /* informacao actualizado */
        return view('livewire.forms.cabecalho.forms-cabecalhos');
    }

    public function sendInfo()
    {

        $this->data['user_id'] = \Auth::user()->id;
        if (config('cian.utilizaldap')) {
            $this->data['email'] = \Auth::user()->ldap->getEmail();
        } else {
            $this->data['email'] = \Auth::user()->email;
        }

        if ($this->data['id']) {
            Mainheader::find($this->data['id'])->update($this->data);
            TaskActivities::create([
                'primavera_email' => auth()->user()->ldap->getEmail(),
                'data_tool_info' => json_encode($this->data, true),
                'action_info' => 'Atualizado o Cabeçalho da Pagina ',
                'seccion_info' => 'Updated',
                'user_id' => auth()->user()->id,
                'task_identity' => $this->data['id'],
                'class_name' => "Livewire.Forms.Cabecalho.FormsCabecalhos"
            ]);
            $this->dispatchBrowserEvent('send-success', ['message' => 'A informação foi actualizada com sucesso!']);
            $this->dispatchBrowserEvent('init-Component');
        } else {
            $tempInstance = Mainheader::create($this->data);
            TaskActivities::create([
                'primavera_email' => auth()->user()->ldap->getEmail(),
                'data_tool_info' => json_encode($this->data, true),
                'action_info' => 'Criado um novo Cabeçalho da Pagina ',
                'seccion_info' => 'Created',
                'user_id' => auth()->user()->id,
                'task_identity' => $tempInstance->id,
                'class_name' => "Livewire.Forms.Cabecalho.FormsCabecalhos"
            ]);

            $this->dispatchBrowserEvent('send-success', ['message' => 'A informação foi gravada com sucesso!']);
            $this->dispatchBrowserEvent('init-Component');
        }

        $this->emit('updatedOne');
        $this->initializeComp();

    }


    public function initializeComp()
    {
        $this->data = array();
    }

    public function updated()
    {
        $this->dispatchBrowserEvent('init-Component');
    }

}
