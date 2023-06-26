<?php

namespace App\Models\Permitions;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 * @package App\Models\Parlamento
 * @version August 15, 2022, 9:49 pm UTC
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


}
