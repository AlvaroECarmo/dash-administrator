<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AuthorMultimedia
 * @package App\Models
 * @version July 7, 2022, 3:04 pm UTC
 *
 * @property string $fullName
 * @property string $titleContext
 * @property integer $Multimedias_id
 * @property integer $user_id
 */
class AuthorMultimedia extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.authorMultimedia';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'fullName',
        'titleContext',
        'Multimedias_id',
        'user_id',
        'urlSternal'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fullName' => 'string',
        'titleContext' => 'string',
        'Multimedias_id' => 'integer',
        'user_id' => 'integer',
        'urlSternal' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fullName' => 'nullable|string|max:200',
        'titleContext' => 'nullable|string',
        'Multimedias_id' => 'nullable',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
