<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class OtherMenu
 * @package App\Models\Parlamento
 * @version October 30, 2022, 9:23 am UTC
 *
 * @property string $url
 * @property string $context
 * @property string $class
 * @property string $key
 * @property integer $type
 * @property integer $elements
 * @property string $toolTip
 * @property integer $ordem
 */
class OtherMenu extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.othermenu';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'url',
        'context',
        'class',
        'key',
        'type',
        'elements',
        'toolTip',
        'ordem'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'context' => 'string',
        'class' => 'string',
        'key' => 'string',
        'type' => 'integer',
        'elements' => 'integer',
        'toolTip' => 'string',
        'ordem' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'nullable|string',
        'context' => 'nullable|string|max:500',
        'class' => 'nullable|string|max:45',
        'key' => 'nullable|string|max:45',
        'type' => 'nullable|integer',
        'elements' => 'nullable|integer',
        'toolTip' => 'nullable|string',
        'ordem' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
