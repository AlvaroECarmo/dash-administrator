<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaAlteracaoEmail extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.PropostaAlteracaoEmails";

    public $timestamps = false;

    protected $fillable =[
        "idOriginal",
        "idPedido",
        "idFicha",
        "emailType_id",
        "email",
        "confidential",
        "tipoRegisto",
        "tipoAlteracao",
        "estado",
    ];

    public static $rulesEmail = [
        'emailType_id' => 'required',
        'email' => 'required|email',
        'confidentialEmail' => 'required'
        ];

    public static $messageEmail = [
        'emailType_id.required' => 'Deve selecionar uma opção',
        'email.required' => 'Deve inserir o email',
        'email.email' => 'Deve indicar o email',
        'confidentialEmail.required' => 'Deve selecionar uma opção'
    ];

    /*=======================================================================================================
                                    Tabela não dependentes a Email (belongTo)
    ========================================================================================================*/
    public function emailType()
    {
        return $this->belongsTo("App\Models\Deputado\EmailType","emailType_id","id");
    }
    /*=======================================================================================================
                                       HELPS
    ========================================================================================================*/
    public static function adicionarEmailOld($listaEmailOld,$idPedido,$idDeputy)
    {
        foreach ($listaEmailOld as $emailOld)
        {
            //Inserir os phones antigos
            $emailOld['estado'] = 0;
            $emailOld['idOriginal'] = $emailOld['idEmail'];
            $emailOld['idPedido'] = $idPedido;
            $emailOld['idFicha'] = $idDeputy;
            PropostaAlteracaoEmail::create($emailOld);
        }
    }

    public static function adicionarEmailNew($listaEmailNew,$idPedido,$idDeputy)
    {
        foreach ($listaEmailNew as $emailNew)
        {
            //Inserir apenas os phones novos e que foram alterados
            if($emailNew['tipoAlteracao'] == 'INSERT')
            {
                $emailNew['idOriginal'] = 0;
                $emailNew['tipoRegisto'] = 'NEW';
                $emailNew['estado'] = 0;
                $emailNew['idPedido'] = $idPedido;
                $emailNew['idFicha'] = $idDeputy;
                PropostaAlteracaoEmail::create($emailNew);

            }else if($emailNew['tipoAlteracao'] != 'NULL')
            {
                $emailNew['idOriginal'] = $emailNew['idEmail'];
                $emailNew['estado'] = 0;
                $emailNew['idPedido'] = $idPedido;
                $emailNew['idFicha'] = $idDeputy;
                PropostaAlteracaoEmail::create($emailNew);
            }
        }

    }

    public static function aprovarEmail($listaEmaisAAprovar)
    {
        foreach ($listaEmaisAAprovar as $email)
        {
            if($email['tipoAlteracao'] == 'INSERT')
            {
               $emailAux =  Email::create(['deputy_id'=>$email['idFicha'],'emailType_id'=>$email['emailType_id'], 'email'=> $email['email'], 'confidential'=>$email['confidential']]);
               PropostaAlteracaoEmail::where('id',$email['id'])->update(['estado' => 1,'idOriginal' => $emailAux->id]);
            }
            else if($email['tipoAlteracao'] == 'UPDATE')
            {
                Email::where('id',$email['idOriginal'])->where('deputy_id',$email['idFicha'])
                    ->update(['emailType_id'=> $email['emailType_id'], 'email'=> $email['email'] , 'confidential'=> $email['confidential']]);
                PropostaAlteracaoEmail::where('id',$email['id'])->update(['estado' => 1]);
            }
            else if($email['tipoAlteracao'] == 'DELETE')
            {
                Email::where('id',$email['idOriginal'])->where('deputy_id',$email['idFicha'])->delete();
                PropostaAlteracaoEmail::where('id',$email['id'])->update(['estado' => 1]);
            }else
                PropostaAlteracaoEmail::where('id',$email['id'])->update(['estado' => 1]);
        }

    }

}
