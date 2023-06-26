<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneType extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.PhoneTypes";

    public $timestamps = false;

    protected $fillable = ["name"];

    /*=======================================================================================================
                                        Tabela dependentes a PhoneTypes
    ========================================================================================================*/
    public function phone()
    {
        return $this->hasMany("App\Models\Deputado\Phone","phoneType_id","id");
    }
}
