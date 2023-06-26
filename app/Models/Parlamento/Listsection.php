<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Listsection
 * @package App\Models
 * @version February 22, 2022, 7:56 pm UTC
 *
 * @property string $title
 * @property string $icon
 * @property integer $SolutionsSection_id
 * @property integer $user_id
 */
class Listsection extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.listsection';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'icon',
        'SolutionsSection_id',
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
        'icon' => 'string',
        'SolutionsSection_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'icon' => 'nullable|string',
        'SolutionsSection_id' => 'nullable',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
