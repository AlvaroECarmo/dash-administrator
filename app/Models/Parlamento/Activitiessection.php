<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Activitiessection
 * @package App\Models
 * @version February 22, 2022, 7:51 pm UTC
 *
 * @property string $title
 * @property string $subTitle
 * @property string $href
 * @property integer $user_id
 */
class Activitiessection extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.activitiessection';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'subTitle',
        'href',
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
        'subTitle' => 'string',
        'href' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:500',
        'subTitle' => 'required|string|max:500',
        'href' => 'required|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
