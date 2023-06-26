<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class GroupsHasViews
 * @package App\Models\Parlamento
 * @version October 11, 2022, 8:51 pm UTC
 *
 * @property string $path
 * @property string $name_views
 * @property integer $view_id
 * @property string $name_group
 * @property integer $group_id
 * @property boolean $crate_permission
 * @property boolean $read_permission
 * @property boolean $update_permission
 * @property boolean $delete_permission
 * @property boolean $publishte_permission
 * @property boolean $status
 */
class GroupsHasViews extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'groups_has_views';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'path',
        'name_views',
        'view_id',
        'name_group',
        'group_id',
        'crate_permission',
        'read_permission',
        'update_permission',
        'delete_permission',
        'publishte_permission',
        'status',
        'view_id_parent'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'path' => 'string',
        'name_views' => 'string',
        'view_id' => 'integer',
        'name_group' => 'string',
        'group_id' => 'integer',
        'crate_permission' => 'boolean',
        'read_permission' => 'boolean',
        'update_permission' => 'boolean',
        'delete_permission' => 'boolean',
        'publishte_permission' => 'boolean',
        'status' => 'boolean',
        'view_id_parent' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'path' => 'nullable|string',
        'name_views' => 'required|string|max:255',
        'view_id' => 'required',
        'name_group' => 'required|string|max:255',
        'group_id' => 'required',
        'crate_permission' => 'nullable|boolean',
        'read_permission' => 'nullable|boolean',
        'update_permission' => 'nullable|boolean',
        'delete_permission' => 'nullable|boolean',
        'publishte_permission' => 'nullable|boolean',
        'status' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'view_id_parent' => 'nullable'
    ];


}
