<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Figure
 * @package App\Models
 * @version February 22, 2022, 7:55 pm UTC
 *
 * @property string $pattern
 * @property string $url
 * @property integer $SolutionsSection_id
 * @property integer $user_id
 */
class Figure extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.figure';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'pattern',
        'url',
        'SolutionsSection_id',
        'image_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pattern' => 'string',
        'url' => 'string',
        'SolutionsSection_id' => 'integer',
        'image_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pattern' => 'nullable|string|max:45',
        'url' => 'nullable|string',
        'SolutionsSection_id' => 'nullable',
        'image_id' => 'nullable',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
