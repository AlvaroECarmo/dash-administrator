<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Group
 * @package App\Models\Parlamento
 * @version October 11, 2022, 1:56 pm UTC
 *
 * @property string $path
 * @property string $full_path
 * @property string $name
 * @property boolean $status
 * @property string $description
 */
class Group extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'groups';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
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
        'path' => 'nullable|string',
        'full_path' => 'nullable|string',
        'name' => 'required|string|max:255',
        'status' => 'nullable|boolean',
        'description' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function groupsHasViews()
    {
        return $this->hasMany(GroupsHasViews::class, 'group_id', 'id')->take(7);
    }


    public static function activitiesUsers($id, string $className)
    {
        return TaskActivities::where('class_name', $className)
          //  ->where('task_identity', $id)
            ->distinct()
            ->get(['user_id', 'primavera_email'])->take(4);

    }


}
