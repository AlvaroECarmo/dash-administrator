<?php


namespace App\Models\External\PRIMAVERA;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Paises';
    protected $connection = 'primavera';
    /**
     * @var array
     */

    protected $primaryKey = 'Pais';

    public function funcionarios()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\Funcionario','Pais','Pais');
    }

}
