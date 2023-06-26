<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\External\MINFIN\ListaAgenteOU;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperHabilitacao
 */
class Habilitacao extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Habilitacoes';
    protected $connection = 'primavera';
    /**
     * @var array
     */

    protected $primaryKey = 'Habilitacao';

    public function funcionarios()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\Funcionario','Habilitacao','Habilitacao');
    }

}
