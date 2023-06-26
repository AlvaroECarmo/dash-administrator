<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tab
 * @package App\Models
 * @version February 22, 2022, 7:57 pm UTC
 *
 * @property integer $tabId
 * @property string $description
 * @property string $url
 * @property string $category
 * @property string $details
 * @property integer $tabsContent_id
 */
class Tab extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.tab';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'tabId',
        'description',
        'url',
        'category',
        'details',
        'tabsContent_id',
        'imageName'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tabId' => 'integer',
        'description' => 'string',
        'url' => 'string',
        'category' => 'string',
        'details' => 'string',
        'tabsContent_id' => 'integer',
        'imageName' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tabId' => 'nullable|integer',
        'description' => 'nullable|string',
        'url' => 'nullable|string',
        'category' => 'nullable|string',
        'details' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'tabsContent_id' => 'nullable',
        'imageName' => 'nullable|string'
    ];

    public static function saveData(array $data, int $idContent): self
    {
        if ($idContent == 2)
            $ordinalStatus = __($data['deputy']['gender'] == 1) ? 'ª Vice Presidente' : 'º Vice Presidente';
        if ($idContent == 3)
            $ordinalStatus = __($data['deputy']['gender'] == 1) ? 'ª Secretário' : 'º Secretário';
        return self::create([
            'tabId' => $idContent,
            'description' => $data['context'],
            'url' => $data['url'],
            'category' => $data['ordem'] . $ordinalStatus,
            'tabsContent_id' => 1,
            'details' => $data['NomeDeputado'],
            'imageName' => $data['imageName']
        ]);

    }

    public function saibaMaisLinks()
    {
        return $this->hasOne(Links::class, 'tab_id', 'id')->where('type', 'saibaMaisLinks')->latest();
    }

    public function shareLinks()
    {
        return $this->hasOne(Links::class, 'tab_id', 'id')->where('type', 'shareLinks')->latest();
    }

    public function postDate()
    {
        return $this->hasOne(Postdate::class, 'tab_id', 'id')->latest();
    }

    public function postInfo()
    {
        return $this->hasMany(Postinfo::class, 'tab_id', 'id')->latest();
    }

    public function tabEntity()
    {
        return $this->hasOne(EntityHistory::class, 'id_tabOriginal', 'id');
    }

    public function socialites()
    {

    }


}
