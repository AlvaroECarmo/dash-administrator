<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\External\MINFIN\ListaAgenteOU;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAgregadoFamiliar
 */
class AgregadoFamiliar extends Model
{
    const DESCENDENTE = 1;
    const ASCENDENTE = 2;
    const CONJUGE = 3;

    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'FuncAgregadoFamiliar';
    protected $connection = 'primavera';
    /**
     * @var array
     */

    protected $fillable = ['Funcionario', 'Nome', 'DataNasc', 'Deficiente','Estudante','TipoAfinidade', 'NumBI', 'DataValidadeBI','Agregado','Activo'];

    protected $primaryKey = ['Funcionario','Agregado'];

}
