<?php

namespace App\Http\Livewire\Forms\EntidadeParlamentar\MensaPresidio;

use App\Models\Parlamento\Schedulessection;
use App\Models\Parlamento\Tabbtnslis;
use Livewire\Component;

class ModalButtomTabs extends Component
{
    public $scheduleSections = array();
    public $tabbtnslist = ['id' => 0];
    public $tabbtnslists = array();

    protected $listeners = ['openSeccaoApresentacao'];

    public function mount(): void
    {
        $this->scheduleSections = Schedulessection::all();
        $this->tabbtnslists = Tabbtnslis::with('schedulesSection')->latest()->get();
    }

    public function render()
    {
        return view('livewire.forms.entidade-parlamentar.mensa-presidio.modal-buttom-tabs');
    }

    public function openSeccaoApresentacao(): void
    {
        $this->dispatchBrowserEvent('open-modal-botton');
    }

    public function saveBtnLists(): void
    {

        if ($this->tabbtnslist['dataTab'] === "#tab-1") {
            $this->tabbtnslist['activeBtn'] = "active-btn";
        } else {
            $this->tabbtnslist['activeBtn'] = "not-active-btn";
        }

        $this->tabbtnslist['user_id'] = auth()->user()->id;

        if (!$this->tabbtnslist['id']) {
            Tabbtnslis::create($this->tabbtnslist);

        } else {
            Tabbtnslis::where('id', $this->tabbtnslist['id'])
                ->update([
                    'context' => $this->tabbtnslist['context']
                ]);
        }

        $this->dispatchBrowserEvent('message-success-tabs', ['message' => 'foi adicionado um item com sucesso']);
        $this->tabbtnslists = Tabbtnslis::with('schedulesSection')->latest()->get();

        $this->render();
    }

    public function editingInfor($attr): void
    {
        $this->tabbtnslist = $attr;
    }

    public function deleteElement($attr): void
    {
        Tabbtnslis::where('id', $attr['id'])
            ->delete();

        $this->render();
    }
}
