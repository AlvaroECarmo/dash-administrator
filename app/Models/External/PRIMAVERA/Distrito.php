<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\External\MINFIN\ListaAgenteOU;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Distritos';
    protected $connection = 'primavera';
    /**
     * @var array
     */

    protected $primaryKey = 'Distrito';

    public function funcionarios()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\Funcionario','CodDistrito','Distrito');
    }

    public function concelhos()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\Concelho','Distrito','Distrito');
    }

}
