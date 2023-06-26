<?php

namespace App\Models\Parlamento;

use App\Models\Traits\Search;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Blogpag
 * @package App\Models
 * @version February 22, 2022, 7:52 pm UTC
 *
 * @property string $img
 * @property string $p
 * @property string $context
 * @property integer $user_id
 */
class Blogpag extends Model
{
    use SoftDeletes;

    use HasFactory;
    use Search;

    public $table = 'Parlamento.blogpag';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";
    protected $searchable = ['context'];

    public $fillable = [
        'img',
        'p',
        'context',
        'user_id',
        'order',
        'destaque',
        'dataEvento',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'img' => 'string',
        'p' => 'string',
        'context' => 'string',
        'user_id' => 'integer',
        'order' => 'integer',
        'destaque' => 'string',
        'dataEvento' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'img' => 'nullable|string',
        'p' => 'nullable|string',
        'context' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'destaque' => 'nullable',
        'order' => 'nullable',
        'dataEvento' => 'nullable'
    ];

    public function multipleItems()
    {
        return $this->hasMany(Multipleitems::class, 'blogPag_id', 'id')->latest();
    }

    public function categories()
    {
        return $this->hasOne(Categories::class, 'blogPag_id', 'id')->latest();
    }

    public function posts()
    {
        return $this->hasOne(Posts::class, 'blogPag_id', 'id')->latest();
    }

    public function anexolists()
    {
        return $this->hasMany(LinkFiles::class, 'parentId', 'id')->latest();
    }

}
