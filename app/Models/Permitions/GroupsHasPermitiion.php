<?php

namespace App\Models\Permitions;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GroupsHasPermitiion
 * @package App\Models\Parlamento
 * @version August 15, 2022, 9:53 pm UTC
 *
 * @property string $path
 * @property string $full_path
 * @property string $name
 * @property string $key_name
 * @property string $key_parent
 * @property boolean $status
 * @property string $description
 */
class GroupsHasPermitiion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'groups_has_permitiion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'path',
        'full_path',
        'name',
        'key_name',
        'key_parent',
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
        'path' => 'string',
        'full_path' => 'string',
        'name' => 'string',
        'key_name' => 'string',
        'key_parent' => 'string',
        'status' => 'boolean',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'path' => 'nullable|string',
        'full_path' => 'nullable|string',
        'name' => 'required|string|max:255',
        'key_name' => 'required|string|max:255',
        'key_parent' => 'required|string|max:255',
        'status' => 'nullable|boolean',
        'description' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
