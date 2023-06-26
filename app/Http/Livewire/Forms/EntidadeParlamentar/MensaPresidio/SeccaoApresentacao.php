<?php

namespace App\Http\Livewire\Forms\EntidadeParlamentar\MensaPresidio;

use App\Models\Parlamento\Schedulessection;
use Livewire\Component;

class SeccaoApresentacao extends Component
{

    public $data = ['id' => 0];
    public $schedulessection = array();
    protected $listeners = ['openNewForm'];

    public function mount()
    {
        $this->schedulessection = Schedulessection::all();
    }


    public function render()
    {
        return view('livewire.forms.entidade-parlamentar.mensa-presidio.seccao-apresentacao');
    }

    public function openNewForm()
    {

        $this->dispatchBrowserEvent('open-modal-apresentacao');
    }

    public function saveThen()
    {
        if ($this->data['id'] > 0)
            Schedulessection::where('id', $this->data['id'])->update([
                'title' => $this->data['title'],
                'context' => $this->data['context']
            ]);
        else
            Schedulessection::create($this->data);

        $this->emit('sendSuccess');
        $this->dispatchBrowserEvent('close-modal-event', ['message' => 'A informação da secção de apresentação foi gravada com sucesso!']);
    }

    public function deleteElement(Schedulessection $item)
    {
        $item->delete();
        $this->dispatchBrowserEvent('message-success', ['message' => 'O item do conteudo de secção foi eliminado!']);
    }

    public function editingInfor(Schedulessection $item)
    {
        $this->data = $item->toArray();
    }

}
