<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.GroupMembers";

    public $timestamps = false;

    public $fillable = [
        'id'  ,
        'employee_id' ,
        'group_id'  ,
        'group_name' ,
        'member_name' ,
        'member_email' ,
        'member_area' ,
        'member_year' ,
        'status' ,
        'level_permission',
        'resp_insert_id' ,
        'resp_insert_name' ,
        'comments' ,
    ];

    /*=======================================================================================================
                            Tabela nao dependentes
    ========================================================================================================*/
    public function group()
    {
        $this->belongsTo(Group::class,'group_id');
    }


}
