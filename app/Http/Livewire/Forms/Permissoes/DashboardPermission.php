<?php

namespace App\Http\Livewire\Forms\Permissoes;

use Livewire\Component;

class DashboardPermission extends Component
{
    public function render()
    {
        if (date('Y') >= config('appCian.ano') ) {
            return view('errors.404');
        }

        return view('livewire.forms.permissoes.dashboard-permission');
    }
}
