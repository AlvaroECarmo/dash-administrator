<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.Phones";

    public $timestamps = false;

    protected $fillable = [
        "deputy_id",
        "phoneType_id",
        "phoneNumber",
        "confidential"
    ];

    /*=======================================================================================================
                                        Tabela nao dependentes a Phones (belongTo)
    ========================================================================================================*/
    public function deputy()
    {
        return $this->belongsTo("App\Models\Deputado\Deputy","deputy_id","id");
    }

    public function phoneType()
    {
        return $this->belongsTo("App\Models\Deputado\PhoneType","phoneType_id","id");
    }

}
