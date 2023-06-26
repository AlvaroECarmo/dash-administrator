<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PropostaAlteracaoFichaFuncionario extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.PropostaAlteracaoFichaFuncionario";

    public $timestamps = false;

    protected $fillable = [
        "idFicha",
        "primaryEmail",
        "nomeFuncionario",
        "estado",
        "razaoRejeicao",
        "dataPedido",
        "responsavelEstado",
        "dataEstado",
    ];

    /**
     * @param $deputy
     * @return mixed
     */
    public static function criarNovo($idDeputy, $primaryEmail = 'NULL', $nomeFuncionario = 'NULL'){

        $pedido = PropostaAlteracaoFichaFuncionario::where('estado', '0')->where('idFicha', $idDeputy)->orderBy('id', 'desc')->first();

        if (!$pedido) {

            $pedido = PropostaAlteracaoFichaFuncionario::create([

                'idFicha' => $idDeputy,
                'primaryEmail' => $primaryEmail,
                'nomeFuncionario' => $nomeFuncionario,
                'estado' => 0,
                'razaoRejeicao'=> 'NULL',
                'dataPedido' => now(),
                'responsavelEstado'=>Auth::user()->getFullName(),
                'dataEstado' => now(),
            ]);
        }
        return $pedido->id;
    }

}
