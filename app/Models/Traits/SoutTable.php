<?php

namespace App\Models\Traits;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\ClassString;
use phpDocumentor\Reflection\Types\This;

trait  SoutTable
{
    public $modelName;

    public function sendSuccess()
    {
        $this->render();
    }

    public function updateItem($item)
    {
        $this->emit('sendContext', $item);
    }

    public function updateTaskOrder($item)
    {
        foreach ($item as $ite) {
            $this->modelName::where('id', $ite['value'])->update(['order' => $ite['order']]);
        }


    }

    public function delectItem($item)
    {
        $this->modelName::find($item['id'])->delete();
        $this->dispatchBrowserEvent('send-success-top-message', ['message' => 'Removido como sucesso!']);
    }

    public function actualizandoTaskOrder($item)
    {
        foreach ($item as $ite) {
            $data = $this->modelName::where('id', $ite['value'])->update(['ordem' => $ite['order']]);
        }
        $this->emit('sendEventList');
    }
}
