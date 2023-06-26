<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Notify
 * @package App\Models\Parlamento
 * @version October 30, 2022, 6:12 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property string $object_iuu
 * @property integer $user_id
 * @property integer $order
 * @property integer $ordem
 * @property string|\Carbon\Carbon $dataEvento
 * @property string $anexo
 */
class Notify extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.notify';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'context',
        'object_iuu',
        'user_id',
        'order',
        'ordem',
        'dataEvento',
        'anexo'
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
        'object_iuu' => 'string',
        'user_id' => 'integer',
        'order' => 'integer',
        'ordem' => 'integer',
        'dataEvento' => 'datetime',
        'anexo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'nullable|string',
        'context' => 'nullable|string',
        'object_iuu' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'order' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'ordem' => 'nullable',
        'dataEvento' => 'nullable',
        'anexo' => 'nullable|string'
    ];

    
}
