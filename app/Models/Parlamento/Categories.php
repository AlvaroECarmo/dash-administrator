<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categories
 * @package App\Models
 * @version February 22, 2022, 7:52 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property integer $blogPag_id
 * @property integer $user_id
 */
class Categories extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'context',
        'blogPag_id',
        'user_id'
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
        'title' => 'required|string',
        'context' => 'nullable|string',
        'blogPag_id' => 'nullable',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function items()
    {
        return $this->hasMany(Items::class, 'categories_id', 'id')->latest();
    }


}
