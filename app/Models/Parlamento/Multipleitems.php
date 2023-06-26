<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Multipleitems
 * @package App\Models
 * @version February 22, 2022, 7:56 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property integer $user_id
 * @property integer $blogPag_id
 */
class Multipleitems extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.multipleitems';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'context',
        'user_id',
        'blogPag_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'context' => 'string',
        'user_id' => 'integer',
        'blogPag_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'context' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'blogPag_id' => 'nullable'
    ];


}
