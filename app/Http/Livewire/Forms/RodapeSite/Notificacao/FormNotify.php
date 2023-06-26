<?php

namespace App\Http\Livewire\Forms\RodapeSite\Notificacao;

use App\Models\Parlamento\Notify;
use Livewire\Component;

class FormNotify extends Component
{

    public $data = ['id' => null];
    protected $listeners = ['editWires'];

    public function render()
    {
        return view('livewire.forms.rodape-site.notificacao.form-notify');
    }

    public function saveJosonNotiy()
    {

        if ($this->data['id'])
            Notify::where('id', $this->data['id'])->update([
                'title' => $this->data['title'],
                'context' => $this->data['context'],
                'user_id' => auth()->user()->id
            ]);
        else
            Notify::create([
                'title' => $this->data['title'],
                'context' => $this->data['context'],
                'user_id' => auth()->user()->id
            ]);


        $this->data = ['id'=> null];

        $this->emit('sucessFrom');
        $this->dispatchBrowserEvent('showSuccess', ['message' => 'Foi adicionado a notificação com sucesso!']);
    }

    public function editWires($attr)
    {
        $this->data = $attr;
    }
}
