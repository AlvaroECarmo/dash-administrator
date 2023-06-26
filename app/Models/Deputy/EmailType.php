<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailType extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected  $table = "DeputyPortal.EmailTypes";

    public $timestamps = false;

    protected $fillable = ["name"];

    /*=======================================================================================================
                                       Tabela dependentes a EmailType
    ========================================================================================================*/
    public function email()
    {
        return $this->hasMany("App\Models\Deputado\Email","emailType_id","id");
    }

}
