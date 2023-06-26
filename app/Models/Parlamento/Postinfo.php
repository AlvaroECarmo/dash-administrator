<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Postinfo
 * @package App\Models
 * @version February 22, 2022, 7:56 pm UTC
 *
 * @property string $circularOutline
 * @property string $icon
 * @property integer $user_id
 * @property integer $tab_id
 */
class Postinfo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.postinfo';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'circularOutline',
        'icon',
        'user_id',
        'tab_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'circularOutline' => 'string',
        'icon' => 'string',
        'user_id' => 'integer',
        'tab_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'circularOutline' => 'required|string|max:45',
        'icon' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'tab_id' => 'nullable'
    ];

    public static function saveData(array $data, $id)
    {
    }


}
