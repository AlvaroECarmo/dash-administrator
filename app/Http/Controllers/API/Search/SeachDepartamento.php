<?php

namespace App\Http\Controllers\API\Search;

use App\Http\Controllers\Controller;
use App\Models\External\PRIMAVERA\Departamento;
use Illuminate\Http\Request;

class SeachDepartamento extends BaseSeach
{
    public function search(Request $request): array
    {
        $pesquisa = self::explodeWord($request->input('term', ''));

        $depo = Departamento::where('Descricao', 'LIKE', $pesquisa . '%')
            ->get(['Departamento as id', 'Descricao as text']);

        return ['results' => $depo];
    }




}
