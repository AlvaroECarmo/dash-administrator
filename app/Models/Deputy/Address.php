<?php

namespace App\Models\Deputy;

use App\Models\External\PRIMAVERA\Concelho;
use App\Models\External\PRIMAVERA\Distrito;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "Addresses";

    public $timestamps = false;

    protected  $fillable = [
        "deputy_id",
        "addressType_id",
        "addrStreet",
        "addrNumber",
        "addrPostalCode",
        "province_id",
        "county_id"
    ];

    /*=======================================================================================================
                                        Tabela nao dependentes a Address (belongTo)
    ========================================================================================================*/
    public function addressType()
    {
        return $this->belongsTo(AddressType::class,"addressType_id","id");
    }

    public function deputy()
    {
        return $this->belongsTo(Deputy::class,"deputy_id","id");
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class,"province_id","Distrito",);
    }

    public function concelho()
    {
        return $this->belongsTo(Concelho::class,'county_id','Concelho');
    }

    /*=======================================================================================================
                                   Helpers
    ========================================================================================================*/
    public static function devolverEnderecosDoFuncionario($idDeputy)
    {
        try {

            $addressAux = [];
            $index = 0;
            $listaAddress = Address::with( 'addressType')->where('deputy_id',$idDeputy)->get()->toArray();

            foreach ($listaAddress as $address)
            {
                $concelhoName = isset($address['province_id']) ? Concelho::where('Distrito',$address['province_id'])
                                    ->where('Concelho',$address['county_id'])->first() : '';

                $distritoName = isset($address['province_id']) ? Distrito::where('Distrito',$address['province_id'])->first() : '' ;

                $addressAux[$index] =  $address;
                $addressAux[$index]['distrito_name'] =  isset($distritoName) ? $distritoName->Descricao : '';
                $addressAux[$index]['concelho_name'] =  isset($concelhoName) ? $concelhoName->Descricao : '';

                $index ++;
            }
            return addressAux;

        }catch (\Exception $ex)
        {
           return isset($addressAux) ? $addressAux: $ex->getMessage();
        }

    }


}
