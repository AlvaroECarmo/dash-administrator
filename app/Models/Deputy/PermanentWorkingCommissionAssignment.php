<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermanentWorkingCommissionAssignment extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected  $table = "DeputyPortal.PermanentWorkingCommissionAssignments";

    public $timestamps = false;

    protected $fillable = [
        "deputy_id",
        "permanentWorkingCommissions_id",
        "permanentWorkingCommissionJobs_id"
    ];


}
