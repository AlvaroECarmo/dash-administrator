<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaAlteracaoEndereco extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.PropostaAlteracaoEnderecos";

    public $timestamps = false;

    protected $fillable = [
        "idOriginal",
        "idPedido",
        "idFicha",
        "addressType_id",
        "addressType",
        "addrStreet",
        "addrNumber",
        "addrPostalCode",
        "province_id",
        "province",
        "county_id",
        "county",
        "tipoRegisto",
        "tipoAlteracao",
        "estado",
    ];

    public static $rulesAddress = [
        "addressType_id" => 'required',
        "addrStreet" => 'required|max:200',
        "addrNumber" => 'required|max:25',
        "addrPostalCode" => 'nullable|max:20',
        "province_id" => 'required',
        "county_id" => 'required',
    ];

    public static $messageAddress = [
        'addressType_id.required' => 'Deve selecionar uma opção',
        'addrStreet.required' => 'Deve inserir o nome da rua',
        'addrStreet.max' => 'O nome da rua deve ter no máximo 200 caráter',
        'addrNumber.required' => 'Deve inserir o número da rua',
        'addrNumber.max' => 'O número da rua deve ter no máximo 200 caráter',
        'addrPostalCode.max' => 'O código postal deve ter no máximo 20 caráter',
        'province_id.required' => 'Deve selecionar a provincia',
        'county_id.required' => 'Deve selecionar o município',
    ];

    public static function adicionarAddressOld($listaAddressOld, $idPedido, $idDeputy)
    {
        foreach ($listaAddressOld as $addressOld) {
            //Inserir os phones antigos
            $addressOld['estado'] = 0;
            $addressOld['idOriginal'] = $addressOld['idAddress'];
            $addressOld['idPedido'] = $idPedido;
            $addressOld['idFicha'] = $idDeputy;
            PropostaAlteracaoEndereco::create($addressOld);
        }
    }

    public static function adicionarAddressNew($listaAddressNew, $idPedido, $idDeputy)
    {
        foreach ($listaAddressNew as $addressNew) {
            //Inserir apenas os phones novos e que foram alterados
            if ($addressNew['tipoAlteracao'] == 'INSERT') {
                $addressNew['idOriginal'] = 0;
                $addressNew['tipoRegisto'] = 'NEW';
                $addressNew['estado'] = 0;
                $addressNew['idPedido'] = $idPedido;
                $addressNew['idFicha'] = $idDeputy;
                PropostaAlteracaoEndereco::create($addressNew);

            } else if ($addressNew['tipoAlteracao'] != 'NULL') {
                $addressNew['idOriginal'] = $addressNew['idAddress'];
                $addressNew['estado'] = 0;
                $addressNew['idPedido'] = $idPedido;
                $addressNew['idFicha'] = $idDeputy;
                PropostaAlteracaoEndereco::create($addressNew);
            }
        }
    }

    public static function aprovarAddress($listaAddressAAprovar)
    {
        foreach ($listaAddressAAprovar as $address)
        {
            if($address['tipoAlteracao'] == 'INSERT')
            {
                $addressAux =   Address::create([
                    'deputy_id'=> $address->idFicha,
                    'addressType_id'=> $address->addressType_id,
                    'addrStreet'=> $address->addrStreet,
                    'addrNumber'=> $address->addrNumber,
                    'addrPostalCode'=> $address->addrPostalCode,
                    'province_id'=> $address->province_id,
                    'county_id'=> $address->county_id
                ]);
                PropostaAlteracaoEndereco::where('id',$address->id)->update(['estado' => 1,'idOriginal' => $addressAux->id]);
            }
            else if($address['tipoAlteracao'] == 'UPDATE')
            {
                Address::where('id',$address->idOriginal)->where('deputy_id',$address->idFicha)->update([
                    'addressType_id'=> $address->addressType_id,
                    'addrStreet'=> $address->addrStreet,
                    'addrNumber'=> $address->addrNumber,
                    'addrPostalCode'=> $address->addrPostalCode,
                    'province_id'=> $address->province_id,
                    'county_id'=> $address->county_id
                ]);
                PropostaAlteracaoEndereco::where('id',$address->id)->update(['estado' => 1]);

            }
            else if($address['tipoAlteracao'] == 'DELETE')
            {
                Address::where('id',$address['idOriginal'])->where('deputy_id',$address['idFicha'])->delete();
                PropostaAlteracaoEndereco::where('id',$address['id'])->update(['estado' => 1]);
            }else
                PropostaAlteracaoEndereco::where('id',$address['id'])->update(['estado' => 1]);
        }
    }
}
