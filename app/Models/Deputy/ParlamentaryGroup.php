<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParlamentaryGroup extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.ParlamentaryGroups";

    public $timestamps = false;

    protected $fillable = ["name"];

    /*=======================================================================================================
                                        Tabelas dependentes a ParlamentaryGroup
    ========================================================================================================*/
    public function deputy(){
        return $this->hasMany("App\Models\Deputado\Deputy","parlamentaryGroup_id","id");
    }
}
