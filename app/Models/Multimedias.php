<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Multimedias
 * @package App\Models
 * @version July 7, 2022, 4:52 pm UTC
 *
 * @property string $urlFile
 * @property string $titleContext
 * @property string $introdutionContext
 * @property string $contextFull
 * @property integer $user_id
 * @property integer $order
 * @property integer $typeMultimedia
 */
class Multimedias extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.Multimedias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'urlFile',
        'titleContext',
        'introdutionContext',
        'contextFull',
        'user_id',
        'order',
        'typeMultimedia',
        'urlSternal'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'urlFile' => 'string',
        'titleContext' => 'string',
        'introdutionContext' => 'string',
        'contextFull' => 'string',
        'user_id' => 'integer',
        'order' => 'integer',
        'typeMultimedia' => 'integer',
        'urlSternal' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'urlFile' => 'nullable|string',
        'titleContext' => 'nullable|string|max:200',
        'introdutionContext' => 'nullable|string|max:400',
        'contextFull' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'order' => 'nullable',
        'urlSternal' => 'nullable',
        'typeMultimedia' => 'nullable|integer'
    ];


}
