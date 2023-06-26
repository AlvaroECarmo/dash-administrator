<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.Gender";

    public $timestamps = false;

    protected  $fillable = ["gender"];


    /*=======================================================================================================
                                Tabela dependentes a Gender
   ========================================================================================================*/
    public function deputy(){
        return $this->hasMany("App\Models\Deputado\Deputy","gender","id");
    }

}
