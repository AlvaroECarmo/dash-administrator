<?php

namespace App\Models\Comuns;

use App\Models\Traits\DataBetween;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GroupMember extends Model
{
    use HasFactory, Notifiable;
    use Search;
    use DataBetween;


    protected $connection = 'ConnectionName';
    protected $table = 'SchemaName.GroupMembers';


    protected $fillable = ['auth', 'authName', 'groupId', 'department', 'email', 'name', 'isAdmin', 'observation', 'cn', 'created_at'];

    protected $searchable = [
        'name', 'authName'
    ];
    protected $dateSeach = ['created_at'];

    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'groupId');
    }

    public static function membrosDa($web)
    {
        /* $grup = Group::where('web', $web)->first();*/
        return self::with('group')->whereHas('group', function ($q) use ($web) {
            $q->where('web', $web);
        })->latest('created_at');
    }


}
