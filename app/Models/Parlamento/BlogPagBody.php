<?php

namespace App\Models\Parlamento;

use App\Models\BlogPagContentsBanner;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPagBody
 * @package App\Models
 * @version June 24, 2022, 1:36 pm UTC
 *
 * @property string $keyMenu
 * @property string $imgCapa
 * @property string $title
 * @property string $context
 * @property string $object_iuu
 * @property integer $blogPagContentsId
 * @property integer $user_id
 * @property integer $order
 */
class BlogPagBody extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.blogPagBody';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'keyMenu',
        'imgCapa',
        'title',
        'context',
        'object_iuu',
        'blogPagContentsId',
        'user_id',
        'order'
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
        'blogPagContentsId' => 'integer',
        'user_id' => 'integer',
        'order' => 'integer'
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
        'blogPagContentsId' => 'nullable',
        'user_id' => 'nullable|integer',
        'order' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function capaImage()
    {
        return BlogPagContents::where('id', $this->blogPagContentsId)->first() ? BlogPagContents::where('id', $this->blogPagContentsId)->first()->imgCapa : null;
    }

    public function banner()
    {
        return $this->hasOne(BlogPagContentsBanner::class, 'blogPagContentsId', 'id')->orderBy('order');
    }

    public function linkFiles()
    {


        return $this->hasMany(LinkFiles::class, 'parentId', 'id')->orderBy('order');
    }
}
