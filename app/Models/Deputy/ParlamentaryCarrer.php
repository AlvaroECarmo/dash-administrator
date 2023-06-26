<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParlamentaryCarrer extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected  $table = "DeputyPortal.ParlamentaryCarrer";

    public $timestamps = false;

    protected $fillable = ["deputy_id","term","startDate"];

}
