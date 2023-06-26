<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
    use HasFactory;

    /**
     * Associar o modelo a devida BD e tabela
     */
    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.AddressTypes";

    public $timestamps = false;

    protected  $fillable = [
        "name"
    ];

    /*=======================================================================================================
                                        Tabelas dependentes a AddressType
    ========================================================================================================*/
    public function address()
    {
        return $this->hasMany(Address::class,"addressType_id","id");
    }

}
