<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingCommissionRole extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.WorkingCommissionRoles";

    public $timestamps = false;

    protected $fillable = ["name"];

    /*=======================================================================================================
                                 Tabela dependentes a WorkingCommissionRoles
    ========================================================================================================*/
    public function deputy(){
        return $this->hasMany("App\Models\Deputado\Deputy","primaryWorkingCommissionRole_id","id");
    }

}
