<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\External\MINFIN\ListaAgenteOU;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperDepartamento
 */
class Departamento extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Departamentos';
    protected $connection = 'primavera';
    /**
     * @var array
     */
    protected $fillable = ['Departamento', 'Descricao'];
    protected $primaryKey = 'Departamento';

    public function funcionarios()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\Funcionario','CodDepartamento','Departamento');
    }

}
