<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.Parties";

    public $timestamps = false;

    protected $fillable = [
        "fullName",
        "shortName"
    ];

    /*=======================================================================================================
                                    Tabela dependentes a Parties
    ========================================================================================================*/
    public function deputy()
    {
        return $this->hasMany("App\Models\Deputado\Deputy","party_id","id");
    }

}
