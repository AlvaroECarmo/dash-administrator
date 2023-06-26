<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.Household";

    public $timestamps = false;

    protected  $fillable = [
        "deputy_id",
        "name",
        "bornDate",
        "bornPlace",
        "kinship_id"
        ];

    /*=======================================================================================================
                                    Tabelas nao dependentes a Household
    ========================================================================================================*/
    public function deputy()
    {
        return $this->belongsTo("App\Models\Deputado\Deputy","deputy_id","id");
    }

    public function kinship()
    {
        return $this->belongsTo("App\Models\Deputado\Kinship","kinship_id","id");
    }

}
