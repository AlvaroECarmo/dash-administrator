<?php

namespace App\Http\Livewire\Comuns;

use Livewire\Component;

class SocialiteForm extends Component
{

    protected $listeners = ['openSocialiteForm'];
    public $instance_id;

    public function render()
    {
        return view('livewire.comuns.socialite-form');
    }

    public function mount()
    {

    }


}
