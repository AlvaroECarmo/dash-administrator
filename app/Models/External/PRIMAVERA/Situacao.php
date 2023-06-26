<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\External\MINFIN\ListaAgenteOU;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSituacao
 */
class Situacao extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Situacoes';
    protected $connection = 'primavera';
    /**
     * @var array
     */

    protected $fillable = ['Situacao', 'Descricao','Tipo'];
    protected $primaryKey = 'Situacao';

    public function funcionarios()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\Funcionario','Situacao','Situacao');
    }

}
