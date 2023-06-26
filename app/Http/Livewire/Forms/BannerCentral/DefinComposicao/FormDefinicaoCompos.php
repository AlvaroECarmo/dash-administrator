<?php

namespace App\Http\Livewire\Forms\BannerCentral\DefinComposicao;

use App\Models\Parlamento\Aboutsection;
use App\Models\Parlamento\Imagebox;
use App\Models\Parlamento\TaskActivities;
use App\Models\Traits\UploadImagen;
use Livewire\Component;
use App\Models\GetJSON;
use Livewire\WithFileUploads;

class FormDefinicaoCompos extends Component
{
    use UploadImagen;
    use WithFileUploads;

    public $data = array();

    public $photo;

    use GetJSON;

    public $bannerCentral;

    public function mount()
    {
        $this->bannerCentral = $this->parseEncode('definicaocomposicao.json')['definicaocomposicao'];
    }

    public function render()
    {
        return view('livewire.forms.banner-central.defin-composicao.form-definicao-compos');
    }

    public function updatedPhoto()
    {
        if ($this->photo)
            $nameImage = $this->photo->temporaryUrl();
        else
            $nameImage = "";

        $this->dispatchBrowserEvent('set-image', ['imageEvent' => $this->photo->temporaryUrl()]);
        $this->dispatchBrowserEvent('activeFunctionality', ['temp_imge' => $nameImage]);
    }

    public function uploadImage()
    {
        $this->dispatchBrowserEvent('updated_image');
    }

    public function saveInfo()
    {

        $imageBox = new Imagebox();
        $imageBox->image = $this->photo->store('imagens/definicao/composicao', 'public');
        $imageBox->imageName = $this->photo->getFileName();

        $aboutSection = Aboutsection::create($this->data);
        $imageBox->aboutSection_id = $aboutSection->id;
        $imageBox->save();

        TaskActivities::createdActivity(
            $aboutSection->toArray(),
            "Livewire.Forms.BannerCentral.FormDefinicaoCompos",
            TaskActivities::CREATE, "Criado a Difinição e Composição "
        );


        $this->dispatchBrowserEvent('success-event', ['message' => 'As informações de difiniçao e composição foram enviados com sucesso!']);
        $this->emit('createdEvent');

    }

    public function removeImage()
    {
        unset($this->photo);
        $this->dispatchBrowserEvent('set-image');
    }
}
