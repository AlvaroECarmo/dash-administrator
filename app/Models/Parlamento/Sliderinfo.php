<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sliderinfo
 * @package App\Models
 * @version February 22, 2022, 7:57 pm UTC
 *
 * @property string $url
 * @property string $h1
 * @property string $p
 * @property string $imgName
 * @property string $href
 * @property integer $user_id
 */
class Sliderinfo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.sliderinfo';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'url',
        'h1',
        'p',
        'href',
        'user_id',
        'description',
        'imgName'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'h1' => 'string',
        'p' => 'string',
        'href' => 'string',
        'user_id' => 'integer',
        'description' => 'string',
        'imgName' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'required|string',
        'h1' => 'required|string',
        'p' => 'required|string',
        'href' => 'required|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'description' => 'nullable|string',
        'imgName' => 'nullable|string'
    ];


}
