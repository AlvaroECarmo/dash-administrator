<?php

namespace App\Models\External\IDONIC;

use App\Models\JustificacaoFaltas\LinhaJustificacaoFalta;
use App\Models\JustificacaoFaltas\LinhaJustificacaoFaltaAusenciaID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\This;

class AsAusencia extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $connection = 'IDONIC';
    protected $table = 'asAusencias';

    // Data,IDPessoa,Validado,IDCod,Tipo,Obs,IDP,IDU,TStamp,Rem,RespValidado,IDInserido,CredFeriasMesAnterior
    protected $fillable = ['Data', 'IDPessoa', 'Validado', 'IDCod', 'Tipo', 'Obs', 'IDP', 'IDU', 'TStamp',
        'Rem', 'Pagar', 'DataInserido', 'CredFeriasMesAnterior', 'RespValidado', 'IDInserido', 'CredFeriasMesAnterior'];
    protected $primaryKey = 'ID';

    public static function asAusencias($idPessoa)
    {
        return self::where('IDPessoa', $idPessoa)->where('Rem', 1)->get(['Data'])->toArray();
    }


    /**
     * -- =======================================================================================
     * --
     * -- Author:  Munzambi Ntemo Miguel
     * -- Create date: 2021-10-24 13:06:46
     * -- Description: Aprova a falta manager
     * --
     * -- Manager dev: Jose Ferreira
     * -- ========================================================================================
     *
     * ALTER PROCEDURE [Departments].[AprovacaoManagerASAusencias]
     * @idJustificacoFalta int,
     * @emailManager varchar(200)
     * AS
     * DECLARE @idManager int
     *
     * SELECT @idManager = P.ID FROM [idonicsys_assnac].dbo.Pessoas P
     * WHERE P.Email = @emailManager
     *
     * UPDATE [idonicsys_assnac].dbo.asAusencias
     * SET Validado = 1, DataValidado = GETDATE(), IDValidado = @idManager
     * WHERE id IN (SELECT LJFA.asAusencia_id FROM Departments.LinhaJustificacaoFaltaAusenciaID LJFA
     * WHERE LJFA.justificacaofalta_id = @idJustificacoFalta)
     *
     * @param $LinhaJustificacaoFaltaAusenciaArrayID
     * @param $idManager
     *
     * @return void
     */

    public static function aprovacaoASAusencias($LinhaJustificacaoFaltaAusenciaArrayID, $idManager): void
    {
        self::whereIn('id', $LinhaJustificacaoFaltaAusenciaArrayID)
            ->update(['Validado' => 1, 'DataValidado' => \Date::now(), 'IDValidado' => $idManager]);
    }

    /**
     * @param $LinhaJustificacaoFaltaAusenciaArrayID
     * @param $idManager
     *
     * [Departments].[RejeicaoManagerASAusencias] SmartObject, execute its Execute method (configure)
     */
    public static function rejeicaoASAusencias($LinhaJustificacaoFaltaAusenciaArrayID, $idManager): void
    {
        self::whereIn('id', $LinhaJustificacaoFaltaAusenciaArrayID)
            ->update(['Validado' => 0, 'Rem' => 1, 'DataValidado' => \Date::now(), 'IDValidado' => $idManager]);
    }

    public static function marcarFaltasManager($data, $justificacao)
    {
        return self::create([
            'Data' => $data,
            'IDPessoa' => $justificacao['pessoa_id'],
            'Validado' => 2,
            'IDCod' => $justificacao['id'],
            'Tipo' => 0,
            'Obs' => $justificacao['observacoes'],
            'IDP' => 9,
            'Pagar' => 0,
            'IDU' => 1,
            'TStamp' => \Date::now(),
            'DataInserido' => \Date::now(),
            'Rem' => 0,
            'CredFeriasMesAnterior' => 0
        ]);
    }

    public static function criaRegistosAsAusencias($linhaJustificacao, $justificacao): void
    {
        foreach ($linhaJustificacao as $linhas) {
            $asAusencia = self::salveAsAusencia($linhas, $justificacao);
            LinhaJustificacaoFaltaAusenciaID::createLinhasJustificacao($asAusencia);
        }
    }

    public static function salveAsAusencia($linhas, $justificacao)
    {
        return self::create([
            'Data' => $linhas['dataFalta'],
            'IDPessoa' => $justificacao['pessoa_id'],
            'Validado' => 2,
            'IDCod' => $justificacao['id'],
            'Tipo' => 0,
            'Obs' => $justificacao['observacoes'],
            'IDP' => 11,
            'IDU' => 1,
            'TStamp' => \Date::now(),
            'Rem' => 0,
            'RespValidado' => 2,
            'IDInserido' => 1,
            'CredFeriasMesAnterior' => 0
        ]);
    }


}
