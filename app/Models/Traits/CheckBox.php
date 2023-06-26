<?php

namespace App\Models\Traits;

use App\Models\External\IDONIC\AsResultado;

trait CheckBox
{
    public $checked;
    public $ListFaltas = array();

    public function selectFalta($falta, $checked): void
    {
        if ($checked)
            $this->ListFaltas[$falta['ID']] = $falta;
        else {
            unset($this->ListFaltas[$falta['ID']]);
        }


    }

    public function selectAllFaltas($target)
    {

        $this->checked = $target;
        if ($target) {
            foreach (AsResultado::faltasInjustificadas(10) as $falta)
                $this->ListFaltas[$falta['ID']] = $falta;
        } else {
            unset($this->ListFaltas);
            $this->ListFaltas = array();
        }

    }
}
