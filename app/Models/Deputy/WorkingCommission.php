<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingCommission extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.WorkingCommissions";

    public $timestamps = false;

    protected $fillable = ["name"];

    /*=======================================================================================================
                                   Tabela dependentes a WorkingCommissions
    ========================================================================================================*/
    public function deputyPrimaryWorkingCommission(){
        return $this->hasMany("App\Models\Deputado\Deputy","primaryWorkingCommission_id","id");
    }

    public function deputySecondaryWorkingCommission(){
        return $this->hasMany("App\Models\Deputado\Deputy","secondaryWorkingCommission_id","id");
    }

}
