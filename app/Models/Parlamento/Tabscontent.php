<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tabscontent
 * @package App\Models
 * @version February 22, 2022, 7:57 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property integer $user_id
 * @property integer $schedulesSection_id
 */
class Tabscontent extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.tabscontent';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'context',
        'user_id',
        'schedulesSection_id'
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
        'user_id' => 'integer',
        'schedulesSection_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:45',
        'context' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'schedulesSection_id' => 'nullable'
    ];

    public function tab2()
    {
        return $this->hasMany(Tab::class, 'tabsContent_id', 'id')->where('tabId', 2)->whereIn('id', EntityHistory::where('order_on', 2)->get('id_tabOriginal as id')->toArray());
    }

    public function tab3()
    {
        return $this->hasMany(Tab::class, 'tabsContent_id', 'id')->where('tabId', 3)->whereIn('id', EntityHistory::where('order_on', 3)->get('id_tabOriginal as id')->toArray());
    }


}
