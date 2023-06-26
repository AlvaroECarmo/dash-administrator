<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Postdate
 * @package App\Models
 * @version February 22, 2022, 7:56 pm UTC
 *
 * @property integer $day
 * @property string $month
 * @property string $year
 * @property integer $user_id
 * @property integer $tab_id
 */
class Postdate extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.postdate';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'day',
        'month',
        'year',
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
        'day' => 'integer',
        'month' => 'string',
        'year' => 'string',
        'user_id' => 'integer',
        'tab_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'day' => 'required|integer',
        'month' => 'required|string|max:45',
        'year' => 'required|string|max:45',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'tab_id' => 'nullable'
    ];

    public static function saveData(string $data, $tabId): self
    {

        $mes = [
            '01' => 'Jan',
            '02' => 'Fev',
            '03' => 'Mar',
            '04' => 'Abr',
            '05' => 'Mai',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Ago',
            '09' => 'Set',
            '10' => 'Out',
            '11' => 'Nov',
            '12' => 'Dez',
        ];

        return self::create([
            'day' => \Date::parse($data)->format('d'),
            'month' => $mes[\Date::parse($data)->format('m')],
            'year' => \Date::parse($data)->format('Y'),
            'user_id' => \Auth::user()->id,
            'tab_id' => $tabId
        ]);
    }


}
