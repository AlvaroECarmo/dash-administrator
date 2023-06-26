<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePropostaAlteracaoTemp extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.EmployeePropostaAlteracaoTemp";

    public $timestamps = false;

    protected $fillable = [

        "idPedido",
        "primaryEmail",
        "fullName",
        "shortName",
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
        "voterCardNumber",
        "socialSecurityNumber",
        "estado",
    ];
}
