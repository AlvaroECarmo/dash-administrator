<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Items
 * @package App\Models
 * @version February 22, 2022, 7:55 pm UTC
 *
 * @property string $href
 * @property string $context
 * @property string $number
 * @property integer $categories_id
 * @property integer $user_id
 * @property string $figure
 * @property string $h6
 * @property string $p
 * @property integer $posts_id
 */
class Items extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.items';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'href',
        'context',
        'number',
        'categories_id',
        'user_id',
        'figure',
        'h6',
        'p',
        'posts_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'href' => 'string',
        'context' => 'string',
        'number' => 'string',
        'categories_id' => 'integer',
        'user_id' => 'integer',
        'figure' => 'string',
        'h6' => 'string',
        'p' => 'string',
        'posts_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'href' => 'nullable|string',
        'context' => 'nullable|string',
        'number' => 'nullable|string',
        'categories_id' => 'nullable',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'figure' => 'nullable|string',
        'h6' => 'nullable|string',
        'p' => 'nullable|string',
        'posts_id' => 'nullable'
    ];


}
