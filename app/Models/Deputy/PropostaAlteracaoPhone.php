<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaAlteracaoPhone extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.PropostaAlteracaoPhones";

    public $timestamps = false;

    protected $fillable = [

        "idOriginal",
        "idPedido",
        "idFicha",
        "phoneType_id",
        "phoneType",
        "phoneNumber",
        "confidential",
        "tipoRegisto",
        "tipoAlteracao",
        "estado",
    ];

    public static function adicionarPhoneOld($listaPhoneOld,$idPedido,$idDeputy)
    {
        foreach ($listaPhoneOld as $phoneOld)
        {
            //Inserir os phones antigos
            $phoneOld['estado'] = 0;
            $phoneOld['idOriginal'] = $phoneOld['idPhone'];
            $phoneOld['idPedido'] = $idPedido;
            $phoneOld['idFicha'] = $idDeputy;
            PropostaAlteracaoPhone::create($phoneOld);
        }
    }

    public static function adicionarPhoneNew($listaPhoneNew,$idPedido,$idDeputy)
    {
        foreach ($listaPhoneNew as $phoneNew)
        {
            //Inserir apenas os phones novos e que foram alterados
            if($phoneNew['tipoAlteracao'] == 'INSERT')
            {
                $phoneNew['idOriginal'] = 0;
                $phoneNew['tipoRegisto'] = 'NEW';
                $phoneNew['estado'] = 0;
                $phoneNew['idPedido'] = $idPedido;
                $phoneNew['idFicha'] = $idDeputy;
                PropostaAlteracaoPhone::create($phoneNew);

            }else if($phoneNew['tipoAlteracao'] != 'NULL')
            {
                $phoneNew['idOriginal'] = $phoneNew['idPhone'];
                $phoneNew['estado'] = 0;
                $phoneNew['idPedido'] = $idPedido;
                $phoneNew['idFicha'] = $idDeputy;
                PropostaAlteracaoPhone::create($phoneNew);
            }
        }

    }

    public static function aprovarPhone($listaPhonesAprovar)
    {
        //dd($listaPhone);
        foreach ($listaPhonesAprovar as $phone)
        {
            if($phone['tipoAlteracao'] == 'INSERT')
            {
                $phoneAux = Phone::create(['deputy_id'=>$phone['idFicha'],'phoneType_id'=>$phone['phoneType_id'], 'phoneNumber'=> $phone['phoneNumber'], 'confidential'=>$phone['confidential']]);
                PropostaAlteracaoPhone::where('id',$phone['id'])->update(['estado' => 1,'idOriginal' => $phoneAux->id]);
            }
            else if($phone['tipoAlteracao'] == 'UPDATE')
            {
                Phone::where('id',$phone['idOriginal'])->where('deputy_id',$phone['idFicha'])
                    ->update(['phoneType_id'=> $phone['phoneType_id'], 'phoneNumber'=> $phone['phoneNumber'] , 'confidential'=> $phone['confidential']]);
                PropostaAlteracaoPhone::where('id',$phone['id'])->update(['estado' => 1]);
            }
            else if($phone['tipoAlteracao'] == 'DELETE')
            {
                Phone::where('id',$phone['idOriginal'])->where('deputy_id',$phone['idFicha'])->delete();
                PropostaAlteracaoPhone::where('id',$phone['id'])->update(['estado' => 1]);
            }else
                PropostaAlteracaoPhone::where('id',$phone['id'])->update(['estado' => 1]);
        }
    }

}
