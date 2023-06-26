<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinship extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.Kinship";

    public $timestamps = false;

    protected $fillable = [
        "fullName"
    ];

    /*=======================================================================================================
                                   Tabela dependentes a Kinship
    ========================================================================================================*/
    public function houseold()
    {
        return $this->hasMany("App\Models\Deputado\Household","kinship_id","id");
    }

    public function propostaAlteracaoHousehold()
    {
        return $this->hasMany("App\Models\Deputado\PropostaAlteracaoHousehold","kinship_id","id");
    }


}
