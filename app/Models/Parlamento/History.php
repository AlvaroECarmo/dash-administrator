<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class History
 * @package App\Models
 * @version February 22, 2022, 7:55 pm UTC
 *
 * @property string $title
 * @property string $p
 * @property string $p2
 * @property integer $user_id
 * @property integer $subscribeInner_id
 */
class History extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.history';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'p',
        'p2',
        'user_id',
        'subscribeInner_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'p' => 'string',
        'p2' => 'string',
        'user_id' => 'integer',
        'subscribeInner_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'nullable|string',
        'p' => 'nullable|string',
        'p2' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'subscribeInner_id' => 'nullable'
    ];


    public function btnList()
    {
        return $this->hasMany(BtnLis)->latest();
    }

    public static function saveData(Subscribeinner $subscrib, array $data): History
    {
        return self::create([
            'title' => 'Presidente',
            'p' => $data['context'],
            'p2' => $data['context'],
            'subscribeInner_id' => $subscrib->id,
            'user_id' => \Auth::user()->id,
        ]);
    }

}
