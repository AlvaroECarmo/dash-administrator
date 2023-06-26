<?php

namespace App\Models\Traits;

trait NTDefaultFunctions
{

    protected $className ;

    /**
     * @param $attr
     * @return void
     * A função tem a finalidade de eliminar um determinado item
     * de uma class
     */
    public function removeElement($attr){
        $this->className::where('id', attr['id'])->delete();
        $this->dispatchBrowserEvent('success-send', ['message' => 'O item foi removido como sucesso!']);
    }
}
