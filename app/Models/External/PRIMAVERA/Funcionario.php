<?php


namespace App\Models\External\PRIMAVERA;


use App\Models\Deputy\Deputy;
use App\Models\External\MINFIN\ListaAgenteOU;
use App\Models\Permitions\GroupsHasUsers;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Funcionario
 *
 * @package App\Models\External\PRIMAVERA
 * @mixin IdeHelperFuncionario
 */
class Funcionario extends Model
{
    const SEXO_MASCULINO = 0;
    const SEXO_FEMININO = 1;

    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    protected $table = 'Funcionarios';
    protected $connection = 'primavera';
    /**
     * @var array
     */
    protected $fillable = ['Codigo', 'Nome', 'Email', 'NumContr', 'Moeda', 'CodEstabelecimento', 'Situacao'];
    protected $primaryKey = 'Codigo';

    public static function correspondenciaMinfin()
    {
        $funcionarios = self::get(['Codigo', 'numBI']);

        foreach ($funcionarios as $funcionario) {
            $agente = ListaAgenteOU::where('numeroBI', '=', $funcionario->numBI)->first();
            if ($agente) {
                $agente->primavera_id = $funcionario->Codigo;
                $agente->save();
            }
        }
    }

    public static function devolveID($numBI)
    {
        $funcionario = Funcionario::where('numBI', '=', $numBI)->get();

        if ($funcionario) {
            return $funcionario->Codigo;
        } else {
            return null;
        }
    }

    public function estabelecimento()
    {
        return $this->hasOne('App\Models\External\PRIMAVERA\Estabelecimento', 'Estabelecimento', 'CodEstabelecimento');
    }

    public function departamento()
    {
        return $this->hasOne('App\Models\External\PRIMAVERA\Departamento', 'Departamento', 'CodDepartamento');
    }

    public function situacao()
    {
        return $this->hasOne('App\Models\External\PRIMAVERA\Situacao', 'Situacao', 'Situacao');
    }

    public function agregado_familiar()
    {
        return $this->hasMany('App\Models\External\PRIMAVERA\AgregadoFamiliar', 'Funcionario', 'Codigo');
    }

    public function profissao()
    {
        return $this->hasOne('App\Models\External\PRIMAVERA\Profissao', 'Profissao', 'Profissao');
    }

    public function habilitacao()
    {
        return $this->hasOne('App\Models\External\PRIMAVERA\Habilitacao', 'Habilitacao', 'Habilitacao');
    }

    public function distrito()
    {
        return $this->hasOne('App\Models\External\PRIMAVERA\Distrito', 'Distrito', 'Distrito');
    }

    public function pais()
    {
        return $this->hasOne('App\Models\External\PRIMAVERA\Pais', 'Pais', 'Pais');
    }


    public function descendentes()
    {
        return $this->agregado_familiar()->where('TipoAfinidade', '=', AgregadoFamiliar::DESCENDENTE)->get();
    }

    public function concelho()
    {
        return Concelho::where('Concelho', '=', $this->Concelho)->where('Distrito', '=', $this->Distrito)->get();
    }

    public function isAgente()
    {
        return $this->estabelecimento->Estabelecimento == config('cian.ESTABELECIMENTO_AGENTES');
    }

    public function isDeputado()
    {
        return $this->estabelecimento->Estabelecimento == config('cian.ESTABELECIMENTO_DEPUTADOS');
    }

    public static function funcionarioPorEmail($email)
    {
        return Funcionario::whereEmail($email)->first();
    }

    public function departmentName()
    {
        Departamento::where('Departamento', $this->CodDepartamento)->get();
    }


    public function groupsInternal()
    {
        return GroupsHasUsers::where('user_email', $this->Email)->get()->take(7) ?? [];
    }

    public function partido()
    {
        return $this->hasOne(Deputy::class,
            'primaryEmail', // chaveEstrageira na outra tabela
            'Email' // chave local na tabela actual
        );
    }
}
