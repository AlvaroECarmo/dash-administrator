<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaAlteracaoCamposBD extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.PropostaAlteracaoCamposBD";

    public $timestamps = false;

    protected $fillable = [
        "campoBD",
        "nomeCampo",
        "TEchaveEstrangeira",
        "TEtabelaEstrangeira",
        "TEcampoChave",
        "TEcampoMostrar",
        "campoBDPrimavera",
        "tipoCampo",
        "existePrimavera",
    ];

}
