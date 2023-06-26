<?php

namespace App\Models\Comuns;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutInOffice extends Model
{
    use HasFactory;

    protected $connection = 'ConnectionName';
    protected $table = 'SchemaName.OutInOffice';

    protected $fillable = [
        'respName', 'respEmail', 'managerName', 'managerEmail',
        'name', 'email', 'outOffice', 'observation', 'dateInOffice',
        'inOffice', 'outOffice', 'personCn', 'managerCn'
    ];

    public static $rules = [
        'respName' => 'required',
        'respEmail' => 'required',
        'managerName' => 'required',
        'managerEmail' => 'required',
        'name' => 'required',
        'email' => 'required',
        'dateInOffice' => 'required|after_or_equal:date',
        'outOffice' => 'required|after_or_equal:date',
        'inOffice' => 'required|after:outOffice',
        'observation' => '',
        'managerCn' => 'required',
        'personCn' => 'required',
    ];


    public static $messages = [
        'outOffice.required' => 'Deve indicar a data da ausencia do manager',
        'inOffice.required' => 'Deve indicar a data de entrada do manager',
        'inOffice.after' => 'A data de entrada tever ser superio a data da ausencia do manager',
        'outOffice.after_or_equal' => 'A data de ausencia deve ser igual ou superior a data actual',
        'managerName.required' => 'Deve indicar a categoria do funcionario manager',
        'name.required' => 'Deve indicar o nome do funcionário a interinar',
    ];

    public static function createEventOffice($data)
    {

        $dataOutInOffice = new self();

        $dataOutInOffice->respName = $data['respName'];
        $dataOutInOffice->respEmail = $data['respEmail'];
        $dataOutInOffice->managerName = $data['managerName'];
        $dataOutInOffice->managerEmail = $data['managerEmail'];
        $dataOutInOffice->name = $data['name'];
        $dataOutInOffice->email = $data['email'];
        $dataOutInOffice->personCn = $data['personCn'];
        $dataOutInOffice->managerCn = $data['managerCn'];
        $dataOutInOffice->observation = $data['observation'];
        $dataOutInOffice->dateInOffice = \Date::parse($data['dateInOffice']);
        $dataOutInOffice->inOffice = $data['inOffice'] ? \Date::parse($data['inOffice'])->format('Y-m-d H:i.s') : null;
        $dataOutInOffice->outOffice = $data['outOffice'] ? \Date::parse($data['outOffice'])->format('Y-m-d H:i.s') : null;

        $dataOutInOffice->save();
    }

}
