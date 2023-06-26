<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lowerbox
 * @package App\Models
 * @version February 22, 2022, 7:56 pm UTC
 *
 * @property string $icon
 * @property string $h5
 * @property string $p
 * @property string $href
 * @property integer $user_id
 * @property integer $aboutSection_id
 */
class Lowerbox extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.lowerbox';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'icon',
        'h5',
        'p',
        'href',
        'user_id',
        'aboutSection_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'icon' => 'string',
        'h5' => 'string',
        'p' => 'string',
        'href' => 'string',
        'user_id' => 'integer',
        'aboutSection_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'icon' => 'required|string',
        'h5' => 'required|string|max:500',
        'p' => 'required|string|max:500',
        'href' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'aboutSection_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
