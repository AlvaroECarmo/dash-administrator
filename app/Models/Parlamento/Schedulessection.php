<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Schedulessection
 * @package App\Models
 * @version February 22, 2022, 7:56 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property integer $user_id
 */
class Schedulessection extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.schedulessection';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
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
        'title' => 'string',
        'context' => 'string',
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
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function tabbtnslis()
    {
        return $this->hasMany(Tabbtnslis::class, 'schedulesSection_id', 'id');
    }

    public function subscribeInner()
    {
        return $this->hasOne(Subscribeinner::class, 'schedulesSection_id', 'id')->latest();
    }

    public function tabsContent()
    {
        return $this->hasOne(Tabscontent::class, 'schedulesSection_id', 'id')->latest();
    }




}
