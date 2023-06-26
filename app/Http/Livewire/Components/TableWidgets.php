<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Base\PaginatedComponent;

abstract class TableWidgets extends PaginatedComponent
{
    public function render()
    {
        return view('livewire.components.table-widgets');
    }
}
