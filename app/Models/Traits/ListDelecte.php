<?php

namespace App\Models\Traits;

use App\Models\JustificacaoFaltas\GroupMember;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ListDelecte
{

    public function delectMember($data)
    {
        $this->emit('eliminarClick', $data);

    }

    public function listenerRender()
    {
        $this->render();
    }

    public function changeMember($data)
    {
        $this->emit('openEditing', $data);
    }

}
