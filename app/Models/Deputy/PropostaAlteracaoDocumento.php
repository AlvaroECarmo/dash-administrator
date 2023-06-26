<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaAlteracaoDocumento extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected  $table = "DeputyPortal.PropostaAlteracaoDocumentos";

    public $timestamps = false;

    public static $listaExtensionImage = ['JPEG','JPG','PNG','jpeg','jpg','png',];
    public static $listaExtensionDocument = ['txt','pdf','doc','docx','xls','xlsx','csv','ppt','pptx','odt','rtf'];

    protected $fillable = [
        "propostaAlterID",
        "nomeDocumento",
        "Documento",
        "estado",
        "idFicha",
    ];

    public static function aprovarDocumentos($listaDocumentos)
    {
        foreach ($listaDocumentos as $documentos)
        {
            PropostaAlteracaoDocumento::where('idFicha',$documentos['idFicha'])->where('estado',0)->update(['estado'=>1]);
        }
    }

    public static function reprovarDocumentos($listaDocumentos)
    {
        foreach ($listaDocumentos as $documentos)
        {
            PropostaAlteracaoDocumento::where('idFicha',$documentos['idFicha'])->where('estado',0)->update(['estado'=>2]);
        }
    }

    public static function isImage($extensao)
    {
        return  in_array($extensao,self::$listaExtensionImage,false);
    }

    public static function isDocument($extensao)
    {
        return  in_array($extensao,self::$listaExtensionDocument,false);
    }

}
