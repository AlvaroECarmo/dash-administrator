<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.Groups";

    public $timestamps = false;

    public $fillable = [
        'year'
        ,'name'
        ,'user_name'
        ,'user_area'
        ,'status'
        ,'comments'
    ];

    /*=======================================================================================================
                                Tabela dependentes a Groups
   ========================================================================================================*/
    public function groupMember()
    {
        return $this->hasMany(GroupMember::class,'group_id');
    }
}
