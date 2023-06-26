<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Posts
 * @package App\Models
 * @version February 23, 2022, 12:43 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property integer $user_id
 */
class Posts extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.posts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'context',
        'user_id',
        'blogPag_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'context' => 'string',
        'blogPag_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'nullable|string',
        'context' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'blogPag_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function items()
    {
        return $this->hasMany(Items::class, 'posts_id')->latest();
    }


}
