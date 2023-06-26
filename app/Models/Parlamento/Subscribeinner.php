<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subscribeinner
 * @package App\Models
 * @version February 22, 2022, 7:57 pm UTC
 *
 * @property string $url
 * @property string $title
 * @property string $p
 * @property string $h6
 * @property string $h7
 * @property string $btnTitle
 * @property integer $user_id
 * @property integer $schedulesSection_id
 */
class Subscribeinner extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.subscribeinner';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'url',
        'title',
        'p',
        'h6',
        'h7',
        'btnTitle',
        'user_id',
        'schedulesSection_id',
        'imageName'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'title' => 'string',
        'p' => 'string',
        'h6' => 'string',
        'h7' => 'string',
        'btnTitle' => 'string',
        'user_id' => 'integer',
        'schedulesSection_id' => 'integer',
        'imageName' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'required|string',
        'title' => 'required|string',
        'p' => 'nullable|string',
        'h6' => 'nullable|string',
        'h7' => 'nullable|string',
        'btnTitle' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'schedulesSection_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'imageName' => 'nullable'
    ];

    public function history()
    {
        return $this->hasOne(History::class, 'subscribeInner_id', 'id')->latest();
    }

    public static function saveData($attr): Subscribeinner
    {
        return self::create([
            'url' => $attr['url'],
            'imageName' => $attr['imageName'],
            'title' => " - ",
            'p' => " - ",
            'h6' => $attr['NomeDeputado'],
            'schedulesSection_id' => $attr['scheduleSection_id'],
            'h7' => "Presidente da Assembleia Nacional",
            'btnTitle' => "Clique para ler mais...",
            'user_id' => \Auth::user()->id,
        ]);
    }

    public function tabEntity()
    {
        return $this->hasOne(EntityHistory::class, 'id_tabOriginal', 'id');
    }

}
