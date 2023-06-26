<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;

class UserWidget extends Widget
{
    public function mount()
    {
        $this->contagem = User::all()->count();

        if ($this->contagem > 1)
            $this->titulo = 'Utilizadores';
        else
            $this->titulo = 'Utilizador';

        $this->icon = "fa fa-user";
        $this->textoUrl = 'Ver todos os utilizadores';
        $this->url = route('listaUsers');
    }

    public function atualizaContagem()
    {
        $this->contagem = User::all()->count();

        if ($this->contagem > 1)
            $this->titulo = 'Utilizadores';
        else
            $this->titulo = 'Utilizador';
    }

}
