<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SocialFunctionality
 * @package App\Models
 * @version July 15, 2022, 12:17 pm UTC
 *
 * @property string $description
 * @property string $longDescription
 * @property integer $user_id
 * @property string $typeWebApp
 * @property integer $scheduleSection_id
 */
class SocialFunctionality extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.socialfunctionality';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'description',
        'longDescription',
        'user_id',
        'typeWebApp',
        'scheduleSection_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'longDescription' => 'string',
        'user_id' => 'integer',
        'typeWebApp' => 'string',
        'scheduleSection_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required|string',
        'longDescription' => 'required|string',
        'user_id' => 'required|integer',
        'typeWebApp' => 'nullable|string|max:200',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'scheduleSection_id' => 'nullable'
    ];


}
