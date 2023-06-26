<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Clearfix
 * @package App\Models
 * @version February 22, 2022, 7:52 pm UTC
 *
 * @property string $url
 * @property string $h3
 * @property string $p
 * @property string $btn
 * @property integer $SolutionsSection_id
 * @property integer $user_id
 * @property string $clearfixcol
 */
class Clearfix extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.clearfix';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'url',
        'h3',
        'p',
        'btn',
        'SolutionsSection_id',
        'user_id',
        'clearfixcol'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'h3' => 'string',
        'p' => 'string',
        'btn' => 'string',
        'SolutionsSection_id' => 'integer',
        'user_id' => 'integer',
        'clearfixcol' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'nullable|string',
        'h3' => 'nullable|string',
        'p' => 'nullable|string',
        'btn' => 'nullable|string',
        'SolutionsSection_id' => 'nullable',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'clearfixcol' => 'nullable|string|max:45',
        'deleted_at' => 'nullable'
    ];


}
