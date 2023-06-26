<?php

namespace App\Http\Livewire\Listas\Component\Datapicker;

use Livewire\Component;

class DataPicker extends Component
{
    public $data;

    public function render()
    {
        return view('livewire.listas.component.datapicker.data-picker');
    }

    public function updatedData()
    {

        $this->emit('dataSend', \Date::parse($this->data)->format('Y-m-d'));
    }
}
