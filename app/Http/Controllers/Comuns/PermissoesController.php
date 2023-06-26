<?php

namespace App\Http\Controllers\Comuns;

use App\Http\Controllers\Controller;

class PermissoesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Comuns.permissoes.permissoes-group');
    }

}
