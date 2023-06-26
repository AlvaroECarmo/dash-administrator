<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Links
 * @package App\Models
 * @version February 22, 2022, 7:55 pm UTC
 *
 * @property string $type
 * @property string $url
 * @property string $context
 * @property integer $user_id
 * @property string $title
 * @property string $text
 * @property integer $tab_id
 */
class Links extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.links';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'type',
        'url',
        'context',
        'user_id',
        'title',
        'text',
        'tab_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'url' => 'string',
        'context' => 'string',
        'user_id' => 'integer',
        'title' => 'string',
        'text' => 'string',
        'tab_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required|string|max:45',
        'url' => 'required|string',
        'context' => 'required|string|max:45',
        'user_id' => 'nullable|integer',
        'title' => 'nullable|string',
        'text' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'tab_id' => 'nullable'
    ];


}
