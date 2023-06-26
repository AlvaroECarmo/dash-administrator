<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\External\MINFIN\ListaAgenteOU;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProfissao
 */
class Profissao extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Profissoes';
    protected $connection = 'primavera';
    /**
     * @var array
     */

    protected $primaryKey = 'Profissao';

    public function funcionarios()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\Funcionario','Profissao','Profissao');
    }

}
