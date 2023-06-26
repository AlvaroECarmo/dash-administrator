<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BlogPagDArticle
 * @package App\Models\Parlamento
 * @version July 30, 2022, 9:35 am UTC
 *
 * @property string $keyMenu
 * @property string $imgCapa
 * @property string $title
 * @property string $context
 * @property string $email
 * @property string $object_iuu
 * @property integer $relactive_id
 * @property integer $user_id
 * @property integer $ordem
 */
class BlogPagDArticle extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.blogPagDArticles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'keyMenu',
        'imgCapa',
        'title',
        'context',
        'email',
        'object_iuu',
        'relactive_id',
        'user_id',
        'ordem'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'keyMenu' => 'string',
        'imgCapa' => 'string',
        'title' => 'string',
        'context' => 'string',
        'email' => 'string',
        'object_iuu' => 'string',
        'relactive_id' => 'integer',
        'user_id' => 'integer',
        'ordem' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'keyMenu' => 'nullable|string',
        'imgCapa' => 'nullable|string',
        'title' => 'nullable|string',
        'context' => 'nullable|string',
        'email' => 'nullable|string',
        'object_iuu' => 'nullable|string',
        'relactive_id' => 'nullable',
        'user_id' => 'nullable|integer',
        'ordem' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
