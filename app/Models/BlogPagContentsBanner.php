<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BlogPagContentsBanner
 * @package App\Models
 * @version July 5, 2022, 10:39 am UTC
 *
 * @property string $imgCapa
 * @property string $auth
 * @property string $context
 * @property integer $user_id
 * @property integer $order
 * @property integer $blogPagContentsId
 * @property integer $menuId
 * @property integer $ordem
 */
class BlogPagContentsBanner extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.blogPagContentsBanner';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'imgCapa',
        'auth',
        'context',
        'user_id',
        'order',
        'blogPagContentsId',
        'menuId',
        'ordem'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'imgCapa' => 'string',
        'auth' => 'string',
        'context' => 'string',
        'user_id' => 'integer',
        'order' => 'integer',
        'blogPagContentsId' => 'integer',
        'menuId' => 'integer',
        'ordem' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'imgCapa' => 'nullable|string',
        'auth' => 'nullable|string|max:100',
        'context' => 'nullable|string|max:200',
        'user_id' => 'nullable|integer',
        'order' => 'nullable',
        'blogPagContentsId' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'menuId' => 'nullable',
        'ordem' => 'nullable'
    ];

    
}
