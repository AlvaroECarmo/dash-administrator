<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Actionhistory
 * @package App\Models
 * @version March 29, 2022, 12:00 pm UTC
 *
 * @property string $email
 * @property integer $user_id
 * @property integer $action_id
 * @property string $context
 * @property string $observation
 * @property string $other
 */
class Actionhistory extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.actionhistory';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'email',
        'user_id',
        'action_id',
        'context',
        'observation',
        'other'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string',
        'user_id' => 'integer',
        'action_id' => 'integer',
        'context' => 'string',
        'observation' => 'string',
        'other' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'action_id' => 'nullable|integer',
        'context' => 'nullable|string',
        'observation' => 'nullable|string',
        'other' => 'nullable|string|max:200',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
