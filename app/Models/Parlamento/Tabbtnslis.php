<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tabbtnslis
 * @package App\Models
 * @version February 22, 2022, 7:57 pm UTC
 *
 * @property string $activeBtn
 * @property string $dataTab
 * @property integer $schedulesSection_id
 * @property string $context
 * @property integer $user_id
 */
class Tabbtnslis extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.tabbtnslis';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'activeBtn',
        'dataTab',
        'schedulesSection_id',
        'context',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'activeBtn' => 'string',
        'dataTab' => 'string',
        'schedulesSection_id' => 'integer',
        'context' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'activeBtn' => 'required|string|max:45',
        'dataTab' => 'required|string|max:45',
        'schedulesSection_id' => 'nullable',
        'context' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function schedulesSection()
    {
        return $this->hasOne(Schedulessection::class, 'id', 'schedulesSection_id');
    }


}
