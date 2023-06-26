<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Configure
 * @package App\Models
 * @version April 11, 2022, 12:46 pm UTC
 *
 * @property string $description
 * @property string $url
 * @property string $category
 * @property string $details
 */
class Configure extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.configures';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'description',
        'url',
        'category',
        'details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'url' => 'string',
        'category' => 'string',
        'details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'nullable|string',
        'url' => 'nullable|string',
        'category' => 'nullable|string',
        'details' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
