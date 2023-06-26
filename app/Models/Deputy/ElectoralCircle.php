<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectoralCircle extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.ElectoralCircle";

    public $timestamps = false;

    protected $fillable = ["name"];

    /*=======================================================================================================
                                 Tabela dependentes a ElectoralCircle
    ========================================================================================================*/
    public function deputy(){
        return $this->hasMany("App\Models\Deputado\Deputy","electoralCircle_id","id");
    }

}
