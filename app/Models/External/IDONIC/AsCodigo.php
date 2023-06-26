<?php

namespace App\Models\External\IDONIC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AsCodigo extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $connection = 'IDONIC';
    protected $table = 'asCodigos';


    protected $fillable = ['Sigla', 'Codigo', 'Descricao'];
    protected $primaryKey = 'ID';
}
