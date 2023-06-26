<?php

namespace App\Http\Livewire\Forms\EntidadeParlamentar\MensaPresidio;

use App\Models\Parlamento\Tabbtnslis;
use Livewire\Component;

class ListaButtomTabs extends Component
{
    public $tabbtnslists = array();

    public function mount()
    {
        //Tabbtnslis
        $this->tabbtnslists = Tabbtnslis::with('schedulesSection')->latest()->get();
    }


    public function render()
    {
        return view('livewire.forms.entidade-parlamentar.mensa-presidio.lista-buttom-tabs');
    }

    public function openConfiguracao()
    {
        $this->emit('openSeccaoApresentacao');
    }

    public function eliminarTabs($attr)
    {
        Tabbtnslis::where('id', $attr)->delete();
        $this->tabbtnslists = Tabbtnslis::with('schedulesSection')->latest()->get();
        $this->dispatchBrowserEvent('message-success-tabs', ['message' => 'foi eliminado um item com sucesso']);
    }
}
