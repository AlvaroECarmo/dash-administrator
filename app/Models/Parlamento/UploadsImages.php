<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UploadsImages
 * @package App\Models\Parlamento
 * @version October 9, 2022, 11:21 am UTC
 *
 * @property integer $user_id
 * @property string $user_email
 * @property string $session
 * @property string $full_path
 * @property string $size
 * @property string $type
 * @property integer $status
 * @property string $url
 * @property string $name
 */
class UploadsImages extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'uploadsImages';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'user_email',
        'session',
        'full_path',
        'size',
        'type',
        'status',
        'url',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'user_email' => 'string',
        'session' => 'string',
        'full_path' => 'string',
        'size' => 'string',
        'type' => 'string',
        'status' => 'integer',
        'url' => 'string',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'user_email' => 'nullable|string|max:500',
        'session' => 'nullable|string',
        'full_path' => 'nullable|string',
        'size' => 'nullable|string|max:100',
        'type' => 'nullable|string|max:50',
        'status' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'url' => 'nullable|string',
        'name' => 'nullable|string'
    ];

    
}
