<?php

namespace App\Models;

use App\Http\Controllers\API\Publish\HeaderContentAPIController;
use App\Http\Controllers\API\Publish\MenuAPIController;

trait FunctionComuns
{

    public function updatedOne()
    {
        $this->render();
    }

    public function publishInfo()
    {

        if (MenuAPIController::publish())
            $this->dispatchBrowserEvent('send-success', ['message' => 'Alterações publicadas com sucesso!']);
        else
            $this->dispatchBrowserEvent('send-success', ['message' => 'Não foi possivel publicar']);

    }

    public function publishInfoHeader()
    {

        if (HeaderContentAPIController::publish())
            $this->dispatchBrowserEvent('send-success', ['message' => 'Alterações publicadas com sucesso!']);
        else
            $this->dispatchBrowserEvent('send-success', ['message' => 'Não foi possivel publicar']);

    }

    protected function sanitizeString($string)
    {

        // matriz de entrada
        $what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç', ' ', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º');

        // matriz de saída
        $by = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'E', 'I', 'O', 'U', 'n', 'n', 'c', 'C', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_');

        // devolver a string
        return str_replace($what, $by, $string);
    }
}
