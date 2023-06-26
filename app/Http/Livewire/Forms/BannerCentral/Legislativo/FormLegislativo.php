<?php

namespace App\Http\Livewire\Forms\BannerCentral\Legislativo;

use Livewire\Component;
use App\Models\GetJSON;
class FormLegislativo extends Component
{

    use GetJSON;

    public $bannerCentral;

    public function mount()
    {

        $this->bannerCentral = $this->parseEncode('gerirmenulegislativo.json')['gerirmenulegislativo'];


    }

    public function render()
    {
        return view('livewire.forms.banner-central.legislativo.form-legislativo');
    }
}
