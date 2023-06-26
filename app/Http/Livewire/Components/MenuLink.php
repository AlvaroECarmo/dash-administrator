<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class MenuLink extends Component
{
    private $title;
    private $url;

    public function mount($title = 'Setting parameter', $url = 'not_found_urls')
    {
        $this->title = $title;
        $this->url = $url;
    }

    public function render()
    {
        return view('livewire.components.menu-link', [
            'url' => $this->url, 'title' => $this->title
        ]);
    }
}
