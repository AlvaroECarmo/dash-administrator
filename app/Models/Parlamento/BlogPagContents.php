<?php

namespace App\Models\Parlamento;

use App\Models\Traits\Search;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPagContents
 * @package App\Models
 * @version June 24, 2022, 1:46 pm UTC
 *
 * @property string $keyMenu
 * @property string $imgCapa
 * @property string $title
 * @property string $context
 * @property string $object_iuu
 * @property integer $user_id
 * @property integer $order
 * @property integer $menuId
 */
class BlogPagContents extends Model
{
    use SoftDeletes;
    use Search;
    use HasFactory;

    public $table = 'Parlamento.blogPagContents';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $searchable = ['title', 'context'];
    public $connection = "Parlamento";

    public $fillable = [
        'keyMenu',
        'imgCapa',
        'title',
        'context',
        'object_iuu',
        'user_id',
        'order',
        'ordem',
        'menuId',
        'anexo'
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
        'object_iuu' => 'string',
        'user_id' => 'integer',
        'order' => 'integer',
        'menuId' => 'integer',
        'anexo' => 'string',
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
        'object_iuu' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'order' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'menuId' => 'nullable'
    ];

    public function blogPageBody()
    {
        return $this->hasMany(BlogPagBody::class, 'blogPagContentsId', 'id')
            ->orderBy('updated_at');
    }

   
}
