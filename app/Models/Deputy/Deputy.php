<?php

namespace App\Models\Deputy;

use Adldap\Laravel\Traits\HasLdapUser;
use App\Models\External\PRIMAVERA\Funcionario;
use App\Models\Traits\Perfis\ApplicationUser;
use App\Models\Traits\Perfis\AssembleiaUser;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Eloquent as Model;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasRoles;

class Deputy extends Model
{
    use HasFactory, Notifiable;
    use HasRoles;
    use HasLdapUser;
    use Search;
    use Impersonate;
    use ApplicationUser, AssembleiaUser;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.Deputy";

    public $timestamps = false;

    protected $searchable = ['fullName', 'shortName'];

    protected $fillable = [
        "primaryEmail",
        "fullName",
        "shortName",
        "electoralCircle_id",
        "party_id",
        "parlamentaryGroup_id",
        "legislature",
        "photo",
        "bornDate",
        "bornPlace",
        "gender",
        "maritalStatus_id",
        "taxPayerNumber",
        "taxRepartion_id",
        "biologicalFather",
        "biologicalMother",
        "idCardNumber",
        "idCardIssuanceDate",
        "idCardExpirationDate",
        "idCardIssuer",
        "passportNumber",
        "passportIssuanceDate",
        "passportExpirationDate",
        "gunHoldingPermitNumber",
        "gunHoldingPermitIssuanceDate",
        "gunHoldingPermitExpirationDate",
        "academicQualification_id",
        "profession_id",
        "otherProfessionalQualifications",
        "publications",
        "commendations",
        "primaryWorkingCommission_id",
        "primaryWorkingCommissionRole_id",
        "secondaryWorkingCommission_id",
        "voterCardNumber",
        "socialSecurityNumber",
        "pedidoAlteracao",
    ];


    /*=======================================================================================================
                                        Tabelas dependentes a Deputy
    ========================================================================================================*/
    public function phone()
    {
        return $this->hasMany("App\Models\Deputado\Phone", "deputy_id", "id");
    }

    public function email()
    {
        return $this->hasMany("App\Models\Deputado\Email", "deputy_id", "id");
    }

    public function propostaAlteracaoHousehold()
    {
        return $this->hasMany("App\Models\Deputado\PropostaAlteracaoHousehold", "idFicha", "id");
    }

    public function household()
    {
        return $this->hasMany("App\Models\Deputado\Household", "deputy_id", "id");
    }

    public function address()
    {
        return $this->hasMany("App\Models\Deputado\Address", "deputy_id", "id");
    }

    /*=======================================================================================================
                                        Tabela nao dependentes a Deputy (belongTo)
    ========================================================================================================*/
    public function academicQualification()
    {
        return $this->belongsTo("App\Models\External\PRIMAVERA\Habilitacao", "academicQualification_id", "Habilitacao");
    }

    public function electoralCircle()
    {
        return $this->belongsTo("App\Models\Deputado\ElectoralCircle", "electoralCircle_id", "id");
    }

    public function gender()
    {
        return $this->belongsTo("App\Models\Deputado\Gender", "gender", "id");
    }

    public function maritalStatus()
    {
        return $this->belongsTo("App\Models\Deputado\MaritalStatus", "maritalStatus_id", "id");
    }

    public function parties()
    {
        return $this->belongsTo(Party::class, "party_id", "id");
    }

    public function parlamentaryGroup()
    {
        return $this->belongsTo("App\Models\Deputado\ParlamentaryGroup", "parlamentaryGroup_id", "id");
    }

    public function profession()
    {
        return $this->belongsTo("App\Models\External\PRIMAVERA\Profissao", "profession_id", "Profissao");
    }

    public function repFinancas()
    {
        return $this->belongsTo("App\Models\External\PRIMAVERA\RepFinancas", "taxRepartion_id", "RepFinanca");
    }

    public function workingCommissionsPrimary()
    {
        return $this->belongsTo("App\Models\Deputado\WorkingCommission", "primaryWorkingCommission_id", "id");
    }

    public function workingCommissionsSecondary()
    {
        return $this->belongsTo("App\Models\Deputado\WorkingCommission", "secondaryWorkingCommission_id", "id");
    }

    public function workingCommissionsRole()
    {
        return $this->belongsTo("App\Models\Deputado\WorkingCommissionRole", "primaryWorkingCommissionRole_id", "id");
    }

    public static function criarDeputyIfNotExist(Funcionario $funcionario)
    {
        $deputy = Deputy::where('primaryEmail', $funcionario->Email)->first();
        if (!isset($deputy)) {
            // dd('Nao exite no Deputy');
            Deputy::create([
                    "primaryEmail" => $funcionario->Email,
                    "fullName" => $funcionario->Nome,
                    "shortName" => $funcionario->NomeAbreviado,
                    "bornDate" => $funcionario->DataNascimento,
                    "bornPlace" => $funcionario->Naturalidade,
                    "gender" => $funcionario->Sexo,
                    "maritalStatus_id" => $funcionario->EstadoCivil,
                    "taxRepartion_id" => $funcionario->CodRepFinancas,
                    "idCardNumber" => $funcionario->NumBI,
                    "idCardIssuer" => $funcionario->LocalEmBi,
                    "idCardIssuanceDate" => $funcionario->DataEmBi,
                    "idCardExpirationDate" => $funcionario->DataValidadeBI,
                    "passportNumber" => $funcionario->NumPassaporte,
                    "passportIssuanceDate" => $funcionario->LocalEmPassaporte,
                    "passportIssuanceDate" => $funcionario->DataEmPassaporte,
                    "passportExpirationDate" => $funcionario->DataValidadePassaporte,
                    "academicQualification_id" => $funcionario->Qualificacao,
                    "profession_id" => $funcionario->Profissao,
                    "socialSecurityNumber" => $funcionario->NumBeneficiario
                ]
            );
        }
    }

}
