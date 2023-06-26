<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\External\MINFIN\ListaAgenteOU;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperConcelho
 */
class Concelho extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Concelhos';
    protected $connection = 'primavera';
    /**
     * @var array
     */

    protected $primaryKey = ['Concelho','Distrito'];

}
