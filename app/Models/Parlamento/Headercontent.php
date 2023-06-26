<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Headercontent
 * @package App\Models
 * @version July 11, 2022, 11:49 am UTC
 *
 * @property string $url
 * @property string $icon
 * @property string $context
 * @property integer $user_id
 * @property integer $socialitesList
 * @property integer $inforList
 * @property integer $linksBox
 * @property integer $listLange
 * @property string $observation
 * @property string $designation
 * @property boolean $status
 * @property integer $parente_id
 * @property integer $order
 * @property integer $tipoItem
 */
class Headercontent extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.headercontent';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'url',
        'icon',
        'context',
        'user_id',
        'socialitesList',
        'inforList',
        'linksBox',
        'listLange',
        'observation',
        'designation',
        'status',
        'parente_id',
        'order',
        'tipoItem'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'icon' => 'string',
        'context' => 'string',
        'user_id' => 'integer',
        'socialitesList' => 'integer',
        'inforList' => 'integer',
        'linksBox' => 'integer',
        'listLange' => 'integer',
        'observation' => 'string',
        'designation' => 'string',
        'status' => 'boolean',
        'parente_id' => 'integer',
        'order' => 'integer',
        'tipoItem' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'nullable|string',
        'icon' => 'nullable|string',
        'context' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'socialitesList' => 'nullable|integer',
        'inforList' => 'nullable|integer',
        'linksBox' => 'nullable|integer',
        'listLange' => 'nullable|integer',
        'observation' => 'nullable|string|max:1000',
        'designation' => 'nullable|string|max:200',
        'status' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'parente_id' => 'nullable',
        'order' => 'nullable',
        'tipoItem' => 'nullable|integer'
    ];

    public function tipeContext()
    {
        if ($this->socialitesList != null)
            return 'Rede Social';
        else if ($this->linksBox != null)
            return 'Box Lista';
        else if ($this->inforList != null)
            return 'Lista de Informação';
        else if ($this->listLange != null)
            return 'Lista de Linguas';
        else
            return '';
    }


}
