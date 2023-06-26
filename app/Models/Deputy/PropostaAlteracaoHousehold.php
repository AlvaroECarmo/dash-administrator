<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaAlteracaoHousehold extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.PropostaAlteracaoHousehold";

    public $timestamps = false;

    protected  $fillable = [
        "idOriginal",
        "idPedido",
        "idFicha",
        "name",
        "bornDate",
        "bornPlace",
        "kinship_id",
        "kinship_descr",
        "tipoRegisto",
        "tipoAlteracao",
        "estado"
    ];

    /*=======================================================================================================
                                    Tabelas dependentes a PropostaAlteracaoHousehold
    ========================================================================================================*/


    /*=======================================================================================================
                                    Tabela nao dependentes a PropostaAlteracaoHousehold (belongTo)
    ========================================================================================================*/
    public function kinship()
    {
        return $this->belongsTo("App\Models\Deputado\Kinship","kinship_id","id");
    }

    public function deputy()
    {
        return $this->belongsTo("App\Models\Deputado\Deputy","idFicha","id");
    }

    public static $rulesHouseHold = [
        "name"=>'required',
        'bornDate'=>'required|date_format:Y-m-d|before_or_equal:date',
        "bornPlace"=>'required',
        "kinship_id"=>'required',
    ];

    public static $messageHouseHold = [
        "name.required"=>'Deve inserir o nome',
        "bornDate.required"=>PropostaAlteracaoDadosPessoal::ERROR_BORN_DATE_REQUIRED,
        "bornDate.before_or_equal"=>PropostaAlteracaoDadosPessoal::ERROR_BORN_DATE_BEFORE_EQUAL,
        "bornPlace.required"=>PropostaAlteracaoDadosPessoal::ERROR_BORN_PLACE_REQUIRED,
        "kinship_id.required"=>'Deve selecionar o grau de parentesco',
    ];

    public static function adicionarHouseHoldOld($listaHouseHoldOld,$idPedido,$idDeputy)
    {
        foreach ($listaHouseHoldOld as $houseHoldOld)
        {
            $houseHoldOld['estado'] = 0;
            $houseHoldOld['idPedido'] = $idPedido;
            $houseHoldOld['idFicha'] = $idDeputy;
            $houseHoldOld['idOriginal'] = $houseHoldOld['idHouseHold'];
            PropostaAlteracaoHousehold::create($houseHoldOld);
        }
    }

    public static function adicionarHouseHoldNew($listaHouseHoldNew, $idPedido, $idDeputy)
    {
        foreach ($listaHouseHoldNew as $houseHold) {

            if ($houseHold['tipoAlteracao'] == 'INSERT') {
                $houseHold['idOriginal'] = 0;
                $houseHold['tipoRegisto'] = 'NEW';
                $houseHold['idPedido'] = $idPedido;
                $houseHold['idFicha'] = $idDeputy;
                PropostaAlteracaoHousehold::create($houseHold);

            } else {
                $houseHold['idOriginal'] = $houseHold['idHouseHold'];
                $houseHold['idPedido'] = $idPedido;
                $houseHold['idFicha'] = $idDeputy;
                PropostaAlteracaoHousehold::create($houseHold);
            }
        }
    }

    public static function aprovarHouseHold($listaHouseHoldAAprovar)
    {
        foreach ($listaHouseHoldAAprovar as $houseHold)
        {
            if($houseHold['tipoAlteracao'] == 'INSERT')
            {
                $houseHoldAux =   Household::create([
                    'deputy_id'=> $houseHold['idFicha'],
                    'name'=> $houseHold['name'],
                    'bornDate'=> $houseHold['bornDate'],
                    'bornPlace'=> $houseHold['bornPlace'],
                    'kinship_id'=> $houseHold['kinship_id']
                ]);
                PropostaAlteracaoHousehold::where('id',$houseHold['id'])->update(['estado' => 1,'idOriginal' => $houseHoldAux->id]);
            }
            else if($houseHold['tipoAlteracao'] == 'UPDATE')
            {
                Household::where('id',$houseHold['idOriginal'])->where('deputy_id',$houseHold['idFicha'])
                    ->update([
                        'name'=> $houseHold['name'],
                        'bornDate'=> $houseHold['bornDate'],
                        'bornPlace'=> $houseHold['bornPlace'],
                        'kinship_id'=> $houseHold['kinship_id']
                    ]);
                PropostaAlteracaoHousehold::where('id',$houseHold['id'])->update(['estado' => 1]);
            }
            else if($houseHold['tipoAlteracao'] == 'DELETE')
            {
                Household::where('id',$houseHold['idOriginal'])->where('deputy_id',$houseHold['idFicha'])->delete();
                PropostaAlteracaoHousehold::where('id',$houseHold['id'])->update(['estado' => 1]);
            }else
                PropostaAlteracaoHousehold::where('id',$houseHold['id'])->update(['estado' => 1]);
        }
    }

    public function actualizarPrimavera()
    {

    }

}
