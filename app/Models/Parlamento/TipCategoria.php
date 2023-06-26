<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TipCategoria
 * @package App\Models\Parlamento
 * @version October 6, 2022, 6:39 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property integer $blogPag_id
 * @property string $typeDescripts
 * @property integer $user_id
 */
class TipCategoria extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.TipCategoria';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'context',
        'blogPag_id',
        'typeDescripts',
        'user_id'
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
        'blogPag_id' => 'integer',
        'typeDescripts' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'context' => 'nullable|string',
        'blogPag_id' => 'nullable|integer',
        'typeDescripts' => 'nullable|string|max:20',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
