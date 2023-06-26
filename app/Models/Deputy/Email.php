<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.Emails";

    public $timestamps = false;

    protected $fillable = [
        "deputy_id",
        "emailType_id",
        "email",
        "confidential",
    ];

    /*=======================================================================================================
                                        Tabela não dependentes a Email (belongTo)
    ========================================================================================================*/
    public function emailType()
    {
        return $this->belongsTo("App\Models\Deputado\EmailType","emailType_id","id");
    }

    public function deputy()
    {
        return $this->belongsTo("App\Models\Deputado\Deputy","deputy_id","id");
    }

}
