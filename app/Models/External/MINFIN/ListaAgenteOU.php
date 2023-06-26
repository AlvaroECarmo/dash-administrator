<?php


namespace App\Models\External\MINFIN;


use App\Models\External\PRIMAVERA\Funcionario;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperListaAgenteOU
 */
class ListaAgenteOU extends Model
{
    protected $table = 'Agente';

    protected $fillable = ['numero','nome','numeroBI','numeroNIF','dataNascimento','numeroFilhos','primavera_id'];

    public static function criaSeNaoExistir($agente)
    {

        try {
            if (self::where('numero', '=', $agente->numero)->count() == 0) {

                self::create($agente->toArray());
            }
            return true;
        } catch (\Exception $e)
        {
           return false;
        }
    }
}
