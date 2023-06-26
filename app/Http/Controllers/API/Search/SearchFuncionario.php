<?php

namespace App\Http\Controllers\API\Search;

use App\Models\External\PRIMAVERA\Funcionario;
use Illuminate\Http\Request;

class SearchFuncionario extends BaseSeach
{
    public function search(Request $request): array
    {
        $pesquisa = self::explodeWord($request->input('term', ''));

        $funcio = Funcionario::where('Nome', 'LIKE', $pesquisa . '%')
            ->get(['Email as id', 'Nome as text']);

        return ['results' => $funcio];
    }
}
