<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Validator;

trait ValidatePhoto
{
    private function validateImage()
    {
        $infors = $this->photo ? $this->photo->temporaryUrl() : null;
        $validado = Validator::make([
            "photo" => $infors
        ], [
            'photo' => 'required',

        ])->setCustomMessages([
            'photo.required' => 'É importante que adiciones uma foto de capa para a imagem...',
        ]);


        if ($validado->fails()) {
            $this->dispatchBrowserEvent('show-fails', ['message' => $validado->getMessageBag()->first()]);
            $validado->validate();
        }

    }
}
