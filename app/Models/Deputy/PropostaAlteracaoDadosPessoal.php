<?php

namespace App\Models\Deputy;

use App\Models\External\PRIMAVERA\Funcionario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaAlteracaoDadosPessoal extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected  $table = "DeputyPortal.PropostaAlteracaoDadosPessoais";

    public $timestamps = false;

    protected $fillable = [
        "idPedido",
        "idFicha",
        "nomeCampo",
        "valorAnteriorCampo",
        "valorAnteriorMostrar",
        "valorCampo",
        "valorCampoMostrar",
        "campoBD",
        "campoBDPrimavera",
        "estado",
        "tipoCampo",
    ];

    const  ERROR_DATE_REQUIRED = "Deve inserir a data";
    const  ERROR_DATE_EMISSAO = 'A data de emissão deve ser inferior a data de expiração';
    const  ERROR_DATE_EXPIRACAO = 'A data de expiração deve ser maior do que a data de emissão';
    const  ERROR_DATE_FORMAT = 'A data deve estar no formato dd-mm-yyyy';
    public const ERROR_BORN_PLACE_REQUIRED = 'Deve inserir o local de nascimento';
    public const ERROR_BORN_DATE_REQUIRED = 'Deve inserir a data de nascimento';
    public const ERROR_BORN_DATE_BEFORE_EQUAL = 'A data de nascimento não pode ser maior do que a data actual';

    public static $rulesDadosPessoais = [
        'primaryEmail'=>'required',
        'fullName'=>'required',
        'shortName'=>'required',
        'bornDate'=>'required|date_format:Y-m-d|before_or_equal:date',
        'bornPlace'=>'required|max:250',
        'gender'=>'required',
        'maritalStatus'=>'required',
    ];

    public static $messageDadosPessoais = [
        'primaryEmail.required'=>'Deve inserir o email',
        'fullName.required'=>'Deve inserir o nome completo',
        'shortName.required'=>'Deve inserir o nome parlamentar',
        'bornDate.required'=>self::ERROR_BORN_DATE_REQUIRED,
        'bornDate.date_format'=>self::ERROR_DATE_FORMAT,
        'bornDate.before_or_equal'=>self::ERROR_BORN_DATE_BEFORE_EQUAL,
        'bornPlace.required'=>self::ERROR_BORN_PLACE_REQUIRED,
        'bornPlace.max'=>'O local de nascimento deve ter no máximo 250 carácter',
        'gender.required'=>'Deve selecionar o genero',
        'maritalStatus.required'=>'Deve selecionar o estado civil',
    ];

    public static $rulesDadosFiscais = [
        'taxPayerNumber' => 'required|min:4|max:16',
        'idTaxRepartion' => 'required',
    ];

    public static $messageDadosFiscais = [
        'taxPayerNumber.required' => 'Deve inserir o número de contribuinte',
        'taxPayerNumber.min' => 'Nº de contribuinte deve ter no mínimo 4 caráter',
        'taxPayerNumber.max' => 'Nº de contribuinte deve ter no maximo 16 caráter',
        'idTaxRepartion.required' => 'Deve selecionar a repartição fiscal',
    ];

    public static $rulesBilheteIdentidade = [
        'idCardNumber'=>'required',
        'idCardIssuer'=>'required|max:250',
        'idCardIssuanceDate'=>'required|date_format:Y-m-d|before_or_equal:today|before_or_equal:idCardExpirationDate',
        'idCardExpirationDate'=>'required|date_format:Y-m-d|after:idCardIssuanceDate',
    ];

    public static $messageBilheteIdentidade = [
        'idCardNumber.required'=>'Deve inserir o numero de BI',
        'idCardIssuer.required'=>'Deve inserir o arquivo de identificação',
        'idCardIssuer.max'=> 'O número de BI deve ter no maximo 250 caráter',
        'idCardIssuanceDate.required' => self::ERROR_DATE_REQUIRED,
        'idCardExpirationDate.required' =>self::ERROR_DATE_REQUIRED,
        'idCardIssuanceDate.date_format' =>self::ERROR_DATE_FORMAT,
        'idCardExpirationDate.date_format' =>self::ERROR_DATE_FORMAT,
        'idCardIssuanceDate.before_or_equal' =>self::ERROR_DATE_EMISSAO,
        'idCardExpirationDate.after' =>self::ERROR_DATE_EXPIRACAO,
    ];

    public static $rulesFilhacao = [
        'biologicalMother'=>'required',
        'biologicalFather'=>'required',
    ];

    public static $messageFilhacao = [
        'biologicalMother.required'=>'Deve inserir o nome da mãe',
        'biologicalFather.required'=>'Deve inserir o nome do pai',
    ];

    public static $rulesLicencaArma = [
        'gunHoldingPermitNumber'=>'nullable|min:4|max:50',
        'gunHoldingPermitIssuanceDate'=>'bail|required_with:gunHoldingPermitNumber|nullable|date_format:Y-m-d|before_or_equal:today|before_or_equal:gunHoldingPermitExpirationDate',
        'gunHoldingPermitExpirationDate'=>'bail|required_with:gunHoldingPermitNumber|nullable|date_format:Y-m-d|after:gunHoldingPermitIssuanceDate',
        ];

    public static $messageLicencaArma = [
        'gunHoldingPermitNumber.min'=>'O número de porte de arma deve ter no mínimo 4 caráter',
        'gunHoldingPermitNumber.max'=>'O número de porte de arma deve ter no máximo 50 caráter',
        'gunHoldingPermitIssuanceDate.required_with'=>self::ERROR_DATE_REQUIRED,
        'gunHoldingPermitExpirationDate.required_with'=>self::ERROR_DATE_REQUIRED,
        'gunHoldingPermitIssuanceDate.before_or_equal'=>self::ERROR_DATE_EMISSAO,
        'gunHoldingPermitExpirationDate.after'=>self::ERROR_DATE_EXPIRACAO,
        'gunHoldingPermitIssuanceDate.date_format'=>self::ERROR_DATE_FORMAT,
        'gunHoldingPermitExpirationDate.date_format'=>self::ERROR_DATE_FORMAT,
    ];

    public static $rulesPassaporte = [
        'passportNumber'=>'bail|nullable|string|max:50|min:6',
        'passportIssuanceDate'=>'bail|sometimes|required_with:passportNumber|nullable|date|date_format:Y-m-d|before_or_equal:today|before:passportExpirationDate',
        'passportExpirationDate'=>'bail|sometimes|required_with:passportNumber|nullable|date|date_format:Y-m-d|after:passportIssuanceDate',
    ];

    public static $messagePassaporte = [
        'passportNumber.required'=>'Deve inserir o número de passaporte',
        'passportNumber.max'=>'O número de passaporte deve ter no maximo 250 caráter',
        'passportNumber.min'=>'O número de passaporte deve ter no mínimo 6 caráter',
        'passportIssuanceDate.required_with'=>self::ERROR_DATE_REQUIRED,
        'passportExpirationDate.required_with'=>self::ERROR_DATE_REQUIRED,
        'passportIssuanceDate.before_or_equal'=>self::ERROR_DATE_EMISSAO,
        'passportExpirationDate.after'=>self::ERROR_DATE_EXPIRACAO,
        'passportIssuanceDate.date_format'=>self::ERROR_DATE_FORMAT,
        'passportExpirationDate.date_format'=>self::ERROR_DATE_FORMAT,
    ];

    public static $rulesSegurancaSocial = [
        'socialSecurityNumber' => 'required|max:50',
        'voterCardNumber' => 'required|max:50',
    ];

    public static $messageSegurancaSocial = [
        'socialSecurityNumber.required' => 'Deve inserir o número de inscrição',
        'socialSecurityNumber.max' => 'O número de segurança social de ter no máximo 50 caráter',
        'voterCardNumber.required' => 'Deve inserir o número de eleitor',
        'voterCardNumber.max' => 'O número de eleitor deve ter no máximo 50 caráter',
    ];

    public static function aprovarDadosPessoais($listaDadosPessoaisAAprovar = [])
    {
        foreach ($listaDadosPessoaisAAprovar as $proposta)
        {
            if($proposta['campoBDPrimavera'] != 'NULL')
            {
                $email = Deputy::where('id',intval($proposta['idFicha']))->first()->primaryEmail;
                Funcionario::where('Email',$email)->update([$proposta['campoBDPrimavera'] => $proposta['valorCampo']]);
                Deputy::where('id',intval($proposta['idFicha']))->update([$proposta['campoBD'] => $proposta['valorCampo']]);
            } else
                Deputy::where('id',intval($proposta['idFicha']))->update([$proposta['campoBD'] => $proposta['valorCampo']]);

            PropostaAlteracaoDadosPessoal::where('idPedido',$proposta['idPedido'])->where('idFicha',$proposta['idFicha'])->where('estado',0)->update(['estado'=>1]);
        }
    }

}
