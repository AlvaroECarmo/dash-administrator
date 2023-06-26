<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;

class ConfiguracoesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Comuns.Configuracoes.dashboard-configuracoes');
    }

}
