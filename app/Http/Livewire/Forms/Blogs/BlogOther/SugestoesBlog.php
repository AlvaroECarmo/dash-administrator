<?php

namespace App\Http\Livewire\Forms\Blogs\BlogOther;

use Livewire\Component;
use Livewire\WithFileUploads;

class SugestoesBlog extends Component
{
    use WithFileUploads;

    public $selectTipoContext;
    public $sugestoes = array();
    public $classElement;   //  drawer drawer-end drawer-on

    protected $listeners = ['openView'];

    public function mount()
    {
        $this->selectTipoContext = 1;
    }

    public function render()
    {
        return view('livewire.forms.blogs.blog-other.sugestoes-blog');
    }

    public function openView()
    {
        $this->classElement = "drawer drawer-end drawer-on";
    }

    public function closView()
    {
        $this->classElement = null;
    }
}
