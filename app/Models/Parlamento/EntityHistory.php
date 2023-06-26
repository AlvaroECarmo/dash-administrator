<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class EntityHistory
 * @package App\Models
 * @version April 20, 2022, 11:42 am UTC
 *
 * @property string $name
 * @property string $url
 * @property string $category
 * @property string $type
 * @property integer $primavera_id
 * @property string $email
 * @property string $contextBloger
 * @property string $objectJson
 */
class EntityHistory extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.entityhistory';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'name',
        'url',
        'category',
        'type',
        'primavera_id',
        'email',
        'contextBloger',
        'objectJson',
        'order_on',
        'order_dem',
        'partido',
        'contexto',
        'id_tabOriginal',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'url' => 'string',
        'category' => 'string',
        'type' => 'string',
        'primavera_id' => 'integer',
        'email' => 'string',
        'contextBloger' => 'string',
        'objectJson' => 'string',
        'order_on' => 'int',
        'order_dem' => 'int',
        'partido' => 'string',
        'contexto' => 'string',
        'id_tabOriginal' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string',
        'url' => 'nullable|string',
        'category' => 'nullable|string',
        'type' => 'nullable|string|max:100',
        'primavera_id' => 'nullable|integer',
        'email' => 'nullable|string',
        'contextBloger' => 'nullable|string',
        'objectJson' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'order_on' => 'nullable|int',
        'order_dem' => 'nullable|int',
        'partido' => 'nullable|string',
        'contexto' => 'nullable|string',
        'id_tabOriginal' => 'nullable|integer',
    ];

    public static function saveData($subscrib, $history, array $data, string $zona,
                                    string $infoTable, string $infoTable2, string $category,
                                    string $typeEntity, $order_dem, $tab_id = 0)
    {

        $attr = array();
        $attr['myData'] = $data;
        $attr[$infoTable] = $history;
        $attr[$infoTable2] = $subscrib;

        $dados = json_encode($attr, true);

        if ($typeEntity == "Presidente") {
            $orderOne = 1;
        }
        if ($typeEntity == "Vices") {
            $orderOne = 2;
        }
        if ($typeEntity == "Secretarios") {
            $orderOne = 3;

        }

        self::create([
            'name' => $data['NomeDeputado'],
            'url' => $data['url'],
            'category' => $category,
            'type' => $zona,
            'primavera_id' => $data['primaveraFunc']['Codigo'],
            'email' => $data['primaveraFunc']['Email'],
            'contextBloger' => $data['context'],
            'objectJson' => $dados,
            'order_on' => $orderOne,
            'order_dem' => $order_dem,
            'id_tabOriginal' => $tab_id
        ]);
    }

    public static function createdDeputado(array $data, string $partido): self
    {
        return self::create([
            'name' => $data['NomeDeputado'],
            'url' => $data['url'],
            'category' => 'Deputado',
            'type' => 'Deputado',
            'primavera_id' => $data['primaveraFunc']['Codigo'],
            'email' => $data['primaveraFunc']['Email'],
            'contextBloger' => $data['context'],
            'objectJson' => json_encode($data, true),
            'order_on' => 0,
            'order_dem' => 0,
            'partido' => $partido,
            'contexto' => $data['context']
        ]);
    }

    public function socialites()
    {
        return $this->hasMany(Social::class, 'deputy_id', 'primavera_id');
    }


    public function tab()
    {
        return $this->hasOne(Tab::class, 'id', 'id_tabOriginal');
    }


}
