<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mainmenu
 * @package App\Models
 * @version February 22, 2022, 7:59 pm UTC
 *
 * @property string $url
 * @property string $context
 * @property string $class
 * @property string $key
 * @property integer $type
 * @property integer $elements
 */
class Mainmenu extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.mainmenu';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'url',
        'context',
        'class',
        'key',
        'type',
        'elements',
        'toolTip',
        'ordem'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'context' => 'string',
        'class' => 'string',
        'key' => 'string',
        'type' => 'integer',
        'elements' => 'integer',
        'toolTip' => 'string',
        'ordem' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'nullable|string',
        'context' => 'nullable|string|max:500',
        'class' => 'nullable|string|max:45',
        'key' => 'nullable|string|max:45',
        'type' => 'nullable|integer',
        'elements' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'toolTip' => 'nullable|string',
        'ordem' => 'nullable|integer',
    ];

    public function elements()
    {
        return $this->hasMany(self::class, 'elements', 'id');
    }

    public function parents(){
        return $this->hasOne(self::class, 'id', 'elements');
    }

    public function getElements()
    {
        return Mainmenu::where('elements', $this->id)->get();
    }


}
