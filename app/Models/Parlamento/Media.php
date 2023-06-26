<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Media
 * @package App\Models
 * @version March 18, 2022, 1:18 pm UTC
 *
 * @property string $name
 * @property string $url
 * @property string $uuid
 * @property integer $user_id
 * @property integer $group_id
 */
class Media extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.media';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'name',
        'url',
        'uuid',
        'user_id',
        'group_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'url' => 'string',
        'uuid' => 'string',
        'user_id' => 'integer',
        'group_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string',
        'url' => 'nullable|string',
        'uuid' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'group_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
