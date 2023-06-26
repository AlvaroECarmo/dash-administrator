<?php

namespace App\Models\Traits;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Livewire\WithFileUploads;

trait NTUploadFunctions
{
    use WithFileUploads;
    use DispatchesJobs;

    public $photo;
    public $image;

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

        $this->image = $this->photo->temporaryUrl();
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
        $this->image = "";
        $this->dispatchBrowserEvent('activeFunctionality');
    }

    public function cliquedEdit($dataInsert = null)
    {
        $this->dispatchBrowserEvent('setEditngValue', ['image' => $dataInsert]);
    }
}
