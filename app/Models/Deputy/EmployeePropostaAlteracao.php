<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePropostaAlteracao extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.EmployeePropostaAlteracao";

    public $timestamps = false;

    protected $fillable = [

        "primaryEmail",
        "fullName",
        "fullNameNovo",
        "shortName",
        "shortNameNovo",
        "photo",
        "bornDate",
        "bornDateNovo",
        "bornPlace",
        "bornPlaceNovo",
        "gender",
        "genderNovo",
        "maritalStatus_id",
        "maritalStatus_idNovo",
        "taxPayerNumber",
        "taxPayerNumberNovo",
        "taxRepartion_id",
        "taxRepartion_idNovo",
        "biologicalFather",
        "biologicalFatherNovo",
        "biologicalMother",
        "biologicalMotherNovo",
        "idCardNumber",
        "idCardNumberNovo",
        "idCardIssuanceDate",
        "idCardIssuanceDateNovo",
        "idCardExpirationDate",
        "idCardExpirationDateNovo",
        "idCardIssuer",
        "idCardIssuerNovo",
        "passportNumber",
        "passportNumberNovo",
        "passportIssuanceDate",
        "passportIssuanceDateNovo",
        "passportExpirationDate",
        "passportExpirationDateNovo",
        "gunHoldingPermitNumber",
        "gunHoldingPermitNumberNovo",
        "gunHoldingPermitIssuanceDate",
        "gunHoldingPermitIssuanceDateNovo",
        "gunHoldingPermitExpirationDate",
        "gunHoldingPermitExpirationDateNovo",
        "academicQualification_id",
        "academicQualification_idNovo",
        "profession_id",
        "profession_idNovo",
        "otherProfessionalQualifications",
        "otherProfessionalQualificationsNovo",
        "publications",
        "publicationsNovo",
        "commendations",
        "commendationsNovo",
        "voterCardNumber",
        "voterCardNumberNovo",
        "socialSecurityNumber",
        "socialSecurityNumberNovo",
        "estado",
    ];



}
