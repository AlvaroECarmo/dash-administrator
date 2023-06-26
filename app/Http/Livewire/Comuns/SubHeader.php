<?php

namespace App\Http\Livewire\Comuns;

use Livewire\Component;

class SubHeader extends Component
{

    public $titleApplication;
    public $titleArea;
    public $departament;

    public function mount($titleApplication = "", $titleArea = "", $departament = "")
    {
        $this->titleApplication = config('cian.KINSARI_APP_NAME');
        $this->titleArea = $titleArea;
        $this->departament = $departament;
    }

    public function render()
    {
        return view('livewire.comuns.sub-header');
    }
}
