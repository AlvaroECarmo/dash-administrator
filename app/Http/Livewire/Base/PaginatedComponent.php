<?php

namespace App\Http\Livewire\Base;

use Livewire\Component;
use Livewire\WithPagination;

class PaginatedComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
}
