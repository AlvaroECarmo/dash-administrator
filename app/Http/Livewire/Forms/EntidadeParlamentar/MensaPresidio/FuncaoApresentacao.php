<?php

namespace App\Http\Livewire\Forms\EntidadeParlamentar\MensaPresidio;

use App\Models\Parlamento\Schedulessection;
use App\Models\Parlamento\SocialFunctionality;
use Livewire\Component;

class FuncaoApresentacao extends Component
{
    public $data = ['id' => null, 'typeWebApp' => null, 'scheduleSection_id' => null];
    protected $listeners = ['openModalFuncao'];
    public $tem;

    public $scheduleSections = array();
    public $socialFunctionality = array();

    public function mount()
    {
        $this->scheduleSections = Schedulessection::all();
        $this->initArrayAll();
    }

    public function render()
    {
        return view('livewire.forms.entidade-parlamentar.mensa-presidio.funcao-apresentacao');
    }

    public function openModalFuncao()
    {
        $this->dispatchBrowserEvent('open-modal-funcao');
    }

    public function saveThenFun()
    {
        if ($this->data['id'] > 0) {
            $this->data['user_id'] = auth()->user()->id;
            $key = $this->data['id'];
            unset($this->data['id']);
            unset($this->data['updated_at']);
            unset($this->data['created_at']);
            unset($this->data['deleted_at']);
            SocialFunctionality::where('id', $key)->update($this->data);

            $this->data = ['id' => null, 'typeWebApp' => null, 'scheduleSection_id' => null];
        } else {
            $this->data['user_id'] = auth()->user()->id;
            SocialFunctionality::create($this->data);
            $this->data = ['id' => null, 'typeWebApp' => null, 'scheduleSection_id' => null];
        }


        /*
            contexto vaido exemplo

            id	    description	user_id	    created_at	            updated_at	                deleted_at	typeWebApp	        longDescription
1	                Presidente	    1	    2022-04-20 09:34:54.877	2022-04-20 09:34:54.877	    NULL	    subscribe_inner	    Presidente da Assembleia Nacional
2	                Vices	        1	    2022-04-20 13:57:07.150	2022-04-20 13:57:07.150	    NULL	    tabId2	            Vice Presidentes da Assembleia Nacional
3	                Secretários	    1	    2022-04-20 14:01:24.947	2022-04-20 14:01:24.947	    NULL	    tabId3	            Secretários da mesa da Assembleia Nacional
4	                Deputado	    1	    2022-04-20 14:01:24.947	2022-04-20 14:01:24.947	    NULL	    Deputado	        Deputado eleito na Assembleia Nacional
         */

        $this->initArrayAll();
        $this->dispatchBrowserEvent('message-success', ['message' => 'Foi inserido com sucesso']);
    }

    public function updatedDataTypeWebApp()
    {
        //  dump($this->data);


    }

    public function deleteElement(SocialFunctionality $attr)
    {
        $attr->delete();
        $this->dispatchBrowserEvent('message-success', ['message' => 'Foi eliminado com sucesso']);
        $this->initArrayAll();
    }

    public function editingInfor(SocialFunctionality $attr)
    {
        $this->data = $attr->toArray();
    }

    public function initArrayAll(){
        $this->socialFunctionality = SocialFunctionality::orderBy('id', 'desc')->get();
    }
}
