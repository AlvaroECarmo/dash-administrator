<?php

namespace App\Models\Deputy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $connection = "FichaDeputado";
    protected $table = "DeputyPortal.MaritalStatuses";

    public $timestamps = false;

    protected $fillable = ["name"];

    public static $localToPrimavera = [
        '0'=>'000',
        '1'=>'001',
        '2'=>'002',
        '3'=>'003',
        '4'=>'004',
        '5'=>'005',
        '6'=>'006',
        '7'=>'007'
    ];
}
