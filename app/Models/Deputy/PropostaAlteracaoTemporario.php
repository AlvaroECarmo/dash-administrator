<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaAlteracaoTemporario extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.PropostaAlteracaoTemporario";

    public $timestamps = false;

    protected $fillable = [

        "idPedido",
        "primaryEmail",
        "fullName",
        "shortName",
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
        "idCardissuer",
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
        "voterCardNumber",
        "socialSecurityNumber",
        "electoralCircle_id",
        "party_id",
        "parlamentaryGroup_id",
    ];


}
