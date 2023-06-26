<?php

namespace App\Models\External\IDONIC;

use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Pessoa extends Model
{
    use HasFactory, Notifiable;
    use Search;

    public $timestamps = false;

    protected $connection = 'IDONIC';
    protected $table = 'Pessoas';

    protected $fillable = ['Nome', 'Numero', 'EmailPessoal', 'Email', 'IDDepartamento'];
    protected $primaryKey = 'ID';

    protected $searchable = ['Nome', 'EmailPessoal', 'Email'];

    public function asResultado()
    {
        return $this->hasMany(AsResultado::class, 'IDPessoa', 'ID');
    }

    public function departamento()
    {
        return $this->hasOne(Departamento::class, 'ID', 'IDDepartamento');
    }

    public function nameDepartamento()
    {
        try {
            return Departamento::where('ID', $this->IDDepartamento)->get('Nome');
        } catch (\Exception $data) {
            return "sem registro";
        }
    }

    public static function getFuncionarioPicagen()
    {
        try {

            if (\Auth::user()->isInterinando() || \Auth::user()->isSuperAdmin()) {
                return self::whereHas('asResultado', function ($q) {
                    $q->where('ID', '>', '0');
                })
                    ->whereIn('Email', \Auth::user()->getMyDirectPorts())
                    ->get();
            }

            if (\Auth::user()->isSuperAdmin())
                return [];

            if (\Auth::user()->isManager() || \Auth::user()->isInterinando())
                return self::whereHas('asResultado', function ($q) {
                    $q->where('ID', '>', '0');
                })
                    ->whereIn('Email', \Auth::user()->getMyDirectPorts())
                    ->get();
            else
                return [];
        } catch (\Exception $ed) {
            return [];
        }

    }


    public static function faltasInjustificadas()
    {

        /* $result = (\DB::connection('Departments')->
         insert('EXEC [Departments].[FaltasInjustificadas] @IdPessoa = 11'));

         return $result;*/
    }

    public static function whereEmail($email): ?object
    {
        try {
            return self::where('Email', $email);
        } catch (\Exception $e) {
            return null;
        }

    }


}
