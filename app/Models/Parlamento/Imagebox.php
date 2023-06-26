<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Imagebox
 * @package App\Models
 * @version February 22, 2022, 7:55 pm UTC
 *
 * @property string $h4
 * @property string $image
 * @property integer $user_id
 * @property integer $aboutSection_id
 * @property string $imageName
 */
class Imagebox extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.imagebox';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'h4',
        'image',
        'user_id',
        'aboutSection_id',
        'imageName'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'h4' => 'nullable|string',
        'image' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'aboutSection_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'h4' => 'string',
        'image' => 'string',
        'user_id' => 'integer',
        'aboutSection_id' => 'integer',
        'imageName' => 'string',
    ];


}
