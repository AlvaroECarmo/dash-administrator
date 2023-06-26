<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\External\MINFIN\ListaAgenteOU;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperEstabelecimento
 */
class Estabelecimento extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Estabelecimentos';
    protected $connection = 'primavera';
    /**
     * @var array
     */
    protected $fillable = ['Estabelecimento', 'Nome'];
    protected $primaryKey = 'Estabelecimento';

    public function funcionarios()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\Funcionario','CodEstabelecimento','Estabelecimento');
    }

}
