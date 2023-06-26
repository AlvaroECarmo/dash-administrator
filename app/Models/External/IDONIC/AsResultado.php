<?php

namespace App\Models\External\IDONIC;

use Adldap\Laravel\Traits\HasLdapUser;
use App\Models\JustificacaoFaltas\JustificacaoFalta;
use App\Models\JustificacaoFaltas\LinhaJustificacaoFalta;
use App\Models\JustificacaoFaltas\MarcarFalta;
use App\Models\Traits\DataBetween;
use App\Models\Traits\GetPesquisa;
use App\Models\Traits\HasCompositePrimaryKey;
use App\Models\Traits\Perfis\ApplicationUser;
use App\Models\Traits\Perfis\AssembleiaUser;
use App\Models\Traits\Search;
use App\Models\Traits\WhereBetween;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use phpDocumentor\Reflection\Types\This;
use PhpParser\Node\Scalar\String_;
use Spatie\Permission\Traits\HasRoles;
use function Illuminate\Support\Facades\App;

class AsResultado extends Model
{
    use HasFactory, Notifiable;
    use HasRoles;
    use HasLdapUser;
    use Authenticatable;
    use Impersonate;
    use ApplicationUser, AssembleiaUser;
    use HasCompositePrimaryKey;
    use Search;
    use DataBetween;
    use GetPesquisa;

    private static $relationShip = "pessoa";
    private static $columnName = "Nome";
    private static $columnEmail = "Email";
    private static $columnDate = 'Data';

    /**
     * @var mixed
     */

    public $timestamps = false;

    protected $connection = 'IDONIC';
    protected $table = 'asResultados';

    protected $fillable = ['IDPessoa', 'Data', 'Falta', 'Tipo', 'Estado', 'Justificacao', 'E1', 'S1', 'Ausencia', 'Observacao'];
    protected $primaryKey = 'ID';

    protected $searchable = ['IDPessoa', 'Data', 'Falta'];
    protected $dateSeach = ['Data'];


    public function pessoa()
    {
        return $this->hasOne(Pessoa::class, 'ID', 'IDPessoa');
    }

    /**
     *   NumFaltas int
     * , IDPessoa     int                -- ID do funcionário
     * , Data     DateTime               -- Data da falta injustificada
     * , Falta DateTime                  -- Tempo de atraso
     * , Tipo      int                   -- Tipo de falta (-1 Indefinido  0 Parcial  1 Folga  2 Feriado  4 Dia completo
     * , Estado int                      -- Estado da falta ( 0 Erro 1 Não validado 2 Pré-Validado 3 Validado 4 Em curso )
     * , Justificacao varchar(max)       -- Justificação da falta
     * , E1    datetime                  -- Data / hora de entrada
     * , S1    datetime                  -- Data / hora de saída
     * , Ausencia datetime
     *
     * @param $idPessoa
     * @return mixed
     */
    public static function faltasInjustificadas($idPessoa)
    {


        try {
            $diaCorrent = date('d') - 1;
            $tempArray = [];  // Array temporario para armazenar o grupo de faltas

            if ($diaCorrent > 5)
                $primeiraData = \DB::raw('dateadd(month, datediff(month, 0, getdate()), 0)');  //  função SQL serve  dateadd(month, datediff(month, 0, getdate()), 0)
            else
                $primeiraData = \DB::raw('dateadd(month, datediff(month, 0, getdate()) - 1, 0)'); // função SQL serve select dateadd(month, datediff(month, 0, getdate()) - 1, 0)


            $segundaData = \DB::raw('dateadd(day, -1, getdate())');


            $data = self::where('IDPessoa', $idPessoa)
                ->whereIn('Estado', [-1, 0, 1])
                ->where('Rem', 0)
                ->whereNotIn('Rem', AsAusencia::where('IDPessoa', $idPessoa)->where('Rem', 1)->get('Rem')->toArray())
                ->whereIn('Rem', AsAusencia::where('IDPessoa', $idPessoa)->orWhere('RespValidado', 0)->orWhere('Validado', 0)->where('Rem', 0)->get('Rem')->toArray())
                ->whereBetween('Data', [$primeiraData, $segundaData])
                ->get(['ID', 'IDPessoa', 'Data', 'Falta', 'Tipo', 'Estado', 'Justificacao', 'E1', 'S1', 'Ausencia'])
                ->groupBy('Data');

            // dump($data);
            foreach ($data as $d) {

                $tempArray[] = $d->first()->toArray()['ID'];
            }

            return self::whereIn('ID', $tempArray);
        } catch (\Exception $ex) {
            return self::whereIn('ID', []);
        }

    }

    public static function countAsResultado($idPessoa)
    {
        return self::where('IDPessoa', $idPessoa)->count();
    }


    public static function faltasInjustificadasContagem($idPessoa)
    {
        if (!$idPessoa)
            return 0;
        //return collect(self::faltasInjustificadas($idPessoa))->count();

        if ((\Auth::user()->isManager() || \Auth::user()->isSuperAdmin())) {
            $total = 0;
            $sub = 0;

            foreach (Pessoa::getFuncionarioPicagen() as $func)
                $total += (self::faltasInjustificadas($func->ID)->count());//- LinhaJustificacaoFalta::devolveNumFaltasEmProcessamento($func->ID));
            foreach (Pessoa::getFuncionarioPicagen() as $func)
                $sub = LinhaJustificacaoFalta::devolveNumFaltasEmProcessamento($func->ID);
            return $total - $sub;
        }

        return self::faltasInjustificadas($idPessoa)->count() - LinhaJustificacaoFalta::devolveNumFaltasEmProcessamento($idPessoa);
    }

    public static function faltasInjustificadasContagemFuncionario($idPessoa)
    {
        if (!$idPessoa)
            return 0;

        return self::faltasInjustificadas($idPessoa)->count() - LinhaJustificacaoFalta::devolveNumFaltasEmProcessamento($idPessoa);
    }


    public function countFaltas(): int
    {
        return self::where('IDPessoa', $this->IDPessoa)
            ->whereIn('Estado', [-1,0, 1])
            ->where('Rem', 0)
            ->whereNotIn('Rem', AsAusencia::where('IDPessoa', $this->IDPessoa)->where('Rem', 1)->get('Rem')->toArray())
            ->whereIn('Rem', AsAusencia::where('IDPessoa', $this->IDPessoa)->orWhere('RespValidado', 0)->orWhere('Validado', 0)->where('Rem', 0)->get('Rem')->toArray())
            ->where('Falta', $this->Falta)
            ->where('Data', $this->Data)
            ->count();
    }


    /**
     * ALTER PROCEDURE [Departments].[UpdateAsResultados]
     * @idJustificacaoFaltas int
     * AS
     * DECLARE @justificacao varchar(300)
     * DECLARE @observacoes varchar(max)
     * DECLARE @idPessoa int
     *
     * SELECT @justificacao = JF.designacaoCodigoJustificacao, @observacoes = JF.observacoes, @idPessoa = JF.pessoa_id
     * FROM Departments.JustificacaoFalta JF
     * WHERE JF.id = @idJustificacaoFaltas
     *
     * UPDATE idonicsys.dbo.asResultados
     * SET Estado = 3, Tipo = 4, Justificacao = @justificacao, Observacao = @observacoes
     * WHERE IDPessoa = @idPessoa AND data IN (
     * SELECT Cast(LJF.dataFalta as date)
     * FROM Departments.LinhaJustificacaoFalta LJF
     * WHERE LJF.justificacaofalta_id = @idJustificacaoFaltas)
     */

    public static function updateAsResultados($jusficacao): void
    {
        $linhasJustificadas = LinhaJustificacaoFalta::where('justificacaofalta_id', $jusficacao['id'])->get('dataFalta')->toArray();
        self::where('IDPessoa', $jusficacao['pessoa_id'])->whereDate('Data', $linhasJustificadas)->update([
            'Estado' => 3,
            'Tipo' => 4,
            'Observacao' => $jusficacao['observacoes'], // observação da justificação
            'Justificacao' => $jusficacao['designacaoCodigoJustificacao'] // designação do codigo de justificação
        ]);
    }


    /**
     * @return bool
     * permite identificar as faltas em processo de justificação
     */
    public function faltaEmprocessamento(): bool
    {
        $idPessoa = $this->IDPessoa;
        $linha = LinhaJustificacaoFalta::with('justificacaoFalta')
            ->whereHas('justificacaoFalta', function ($q) use ($idPessoa) {
                $q->where('pessoa_id', $idPessoa);
                $q->where('estado', '!=', 2);
            })->whereDate('dataFalta', $this->Data)
            ->get()->toArray();

        return $linha ? true : false;
    }

    public function faltaJustificada(): string
    {
        $idPessoa = $this->IDPessoa;
        $linha = LinhaJustificacaoFalta::with('justificacaoFalta')
            ->whereHas('justificacaoFalta', function ($q) use ($idPessoa) {
                $q->where('pessoa_id', $idPessoa);
                $q->where('estado', '!=', 2);
            })->whereDate('dataFalta', $this->Data)
            ->get()->toArray();

        if ($linha) {
            return (collect($linha)->first())['justificacao_falta']['designacaoCodigoJustificacao'];
        } else
            return "Sem justificação";
    }


    public function faltaMarcadaDr(): bool
    {
        try {


            $data = MarcarFalta::where('pessoa_id', $this->IDPessoa)->where('data', $this->Data)->get()->toArray();

            return $data ? true : false;
        } catch (\Exception $d) {
            return false;
        }
    }


    public static function faltasInjustificadasCopia($idPessoa)
    {

        try {
            $diaCorrent = date('d') - 1;
            $tempArray = [];  // Array temporario para armazenar o grupo de faltas

            if ($diaCorrent > 5)
                $primeiraData = \DB::raw('dateadd(month, datediff(month, 0, getdate()), 0)');  //  função SQL serve  dateadd(month, datediff(month, 0, getdate()), 0)
            else
                $primeiraData = \DB::raw('dateadd(month, datediff(month, 0, getdate()) - 1, 0)'); // função SQL serve select dateadd(month, datediff(month, 0, getdate()) - 1, 0)


            $segundaData = \DB::raw('dateadd(day, -1, getdate())');


            $data = self::where('IDPessoa', $idPessoa)
                ->whereIn('Estado', [-1,0, 1, 2])
                ->whereBetween('Data', [$primeiraData, $segundaData])
                ->get(['ID', 'IDPessoa', 'Data', 'Falta', 'Tipo', 'Estado', 'Justificacao', 'E1', 'S1', 'Ausencia'])
                ->groupBy('Data');
            foreach ($data as $d)
                $tempArray[] = $d->first()->toArray()['ID'];

            return self::whereIn('ID', $tempArray);
        } catch (\Exception $ex) {
            return self::whereIn('ID', []);
        }

    }

}
