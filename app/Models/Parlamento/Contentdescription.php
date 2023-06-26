<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contentdescription
 * @package App\Models
 * @version February 22, 2022, 7:52 pm UTC
 *
 * @property string $title
 * @property string $title1
 * @property string $context
 * @property string $phone
 * @property string $numb
 * @property string $email
 * @property string $text
 * @property integer $mainFooter_id
 * @property integer $user_id
 * @property string $type
 */
class Contentdescription extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.contentdescription';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'title1',
        'context',
        'phone',
        'numb',
        'email',
        'text',
        'gruParliamentary',
        'location',
        'responsible',
        'user_id',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'title1' => 'string',
        'context' => 'string',
        'phone' => 'string',
        'numb' => 'string',
        'email' => 'string',
        'text' => 'string',
        'gruParliamentary' => 'integer',
        'location' => 'integer',
        'responsible' => 'integer',
        'user_id' => 'integer',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'nullable|string|max:45',
        'title1' => 'nullable|string|max:45',
        'context' => 'nullable|string',
        'phone' => 'nullable|string|max:45',
        'numb' => 'nullable|string|max:45',
        'email' => 'nullable|string',
        'text' => 'nullable|string',
        'gruParliamentary' => 'nullable',
        'location' => 'nullable',
        'responsible' => 'nullable',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'type' => 'nullable|string|max:45'
    ];


}
