<?php

namespace App\Models\Permitions;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GroupsHasUsers
 * @package App\Models\Parlamento
 * @version August 15, 2022, 9:56 pm UTC
 *
 * @property integer $user_id
 * @property string $user_email
 * @property integer $group_id
 * @property boolean $read_permition
 * @property boolean $write_permition
 * @property string $path
 * @property string $full_path
 * @property string $name
 * @property boolean $status
 * @property string $description
 */
class GroupsHasUsers extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'groups_has_users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'user_email',
        'group_id',
        'read_permition',
        'write_permition',
        'path',
        'full_path',
        'name',
        'status',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'user_email' => 'string',
        'group_id' => 'integer',
        'read_permition' => 'boolean',
        'write_permition' => 'boolean',
        'path' => 'string',
        'full_path' => 'string',
        'name' => 'string',
        'status' => 'boolean',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'user_email' => 'nullable',
        'group_id' => 'nullable',
        'read_permition' => 'nullable|boolean',
        'write_permition' => 'nullable|boolean',
        'path' => 'nullable|string',
        'full_path' => 'nullable|string',
        'name' => 'required|string|max:255',
        'status' => 'nullable|boolean',
        'description' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function groups()
    {
        return $this->hasMany(\App\Models\Parlamento\Group::class, 'id', 'group_id');
    }


}
