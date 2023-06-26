<?php

namespace App\Models;

use Livewire\Component;
use Livewire\WithFileUploads;

class  NTUploadImage extends Component
{
    use WithFileUploads;

    public $photo;

    public function uploadImage()
    {

        $this->dispatchBrowserEvent('upload-image-click');
    }

    public function updatedPhoto()
    {
        if ($this->photo)
            $nameImage = $this->photo->temporaryUrl();
        else
            $nameImage = "";

        $this->dispatchBrowserEvent('activeFunctionality', ['temp_image' => $nameImage]);
    }

    public function removeUpload()
    {
        unset($this->photo);
        $this->dispatchBrowserEvent('activeFunctionality');
    }

    public function removeImage()
    {
        $this->photo = "";

        $this->dispatchBrowserEvent('activeFunctionality');
    }

}
