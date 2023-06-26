<?php

namespace App\Http\Livewire\Listas\Component\Datapicker;

use Livewire\Component;

class RangeDatapicker extends Component
{
    public $rangeDate = ['initialDate' => '', 'finalDate'];

    /*
        public $initialDate;
        public $finalDate;*/
    public function render()
    {
        return view('livewire.listas.component.datapicker.range-datapicker');
    }

    public function updatedRangeDate()
    {
        $this->emit('rangeData', $this->rangeDate);
    }

    public function resetMethod()
    {
        $this->reset();
        $this->emit('reseting');
    }

}
