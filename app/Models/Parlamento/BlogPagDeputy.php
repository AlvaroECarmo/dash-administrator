<?php

namespace App\Models\Parlamento;

use App\Models\Deputy\Deputy;
use App\Models\Traits\Search;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BlogPagDeputy
 * @package App\Models\Parlamento
 * @version August 14, 2022, 12:18 am UTC
 *
 * @property string $keyMenu
 * @property string $imgCapa
 * @property string $title
 * @property string $context
 * @property string $email
 * @property string $object_iuu
 * @property integer $user_id
 * @property integer $ordem
 * @property string $localkeyMenu
 * @property string $entityType
 */
class BlogPagDeputy extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Search;

    public $table = 'Parlamento.blogPagDeputies';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'keyMenu',
        'imgCapa',
        'title',
        'context',
        'email',
        'object_iuu',
        'localkeyMenu',
        'entityType',
        'cargoID',
        'cargoText',
        'departamentoID',
        'departamentoName',
        'titleCapa'
    ];

    protected $searchable = [
        'title', 'email', 'localkeyMenu', 'context'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'keyMenu' => 'string',
        'imgCapa' => 'string',
        'title' => 'string',
        'context' => 'string',
        'email' => 'string',
        'object_iuu' => 'string',
        'user_id' => 'integer',
        'ordem' => 'integer',
        'localkeyMenu' => 'string',
        'cargoID' => 'integer',
        'departamentoID' => 'integer',
        'cargoText' => 'string',
        'departamentoName' => 'string',
        'entityType' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'keyMenu' => 'nullable|string',
        'imgCapa' => 'nullable|string',
        'title' => 'nullable|string',
        'context' => 'nullable|string',
        'email' => 'nullable|string',
        'object_iuu' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'ordem' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'localkeyMenu' => 'nullable|string',
        'entityType' => 'nullable|string|max:50'
    ];

    public function socials()
    {
        return $this->hasMany(Social::class, 'aboutSection', 'id');
    }

    public function depudy()
    {
        return $this->hasOne(Deputy::class, 'primaryEmail', 'email');
    }

    public function legislature()
    {
        return $this->hasOne(Mainmenu::class, 'url', 'localkeyMenu');
    }

    public function category()
    {
        return $this->hasOne(TipCategoria::class, 'id', 'cargoID');
    }

}
