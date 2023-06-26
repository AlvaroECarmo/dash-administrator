<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Exception;

/**
 * Class TaskActivities
 * @package App\Models
 * @version June 15, 2022, 10:08 am UTC
 *
 * @property string $primavera_email
 * @property string $data_tool_info
 * @property string $action_info
 * @property string $seccion_info
 * @property integer $user_id
 * @property integer $order
 */
class TaskActivities extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.taskActivities';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const DELETE = 'Delete';
    const CREATE = 'Create';
    const UPDATE = 'Update';

    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'primavera_email',
        'data_tool_info',
        'action_info',
        'seccion_info',
        'user_id',
        'order',
        'task_identity',
        'class_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'primavera_email' => 'string',
        'data_tool_info' => 'string',
        'action_info' => 'string',
        'seccion_info' => 'string',
        'user_id' => 'integer',
        'order' => 'integer',
        'task_identity' => 'integer',
        'class_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'primavera_email' => 'nullable|string',
        'data_tool_info' => 'nullable|string',
        'action_info' => 'nullable|string',
        'seccion_info' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'order' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'task_identity' => 'nullable',
        'class_name' => 'nullable',
    ];


    public function users()
    {
        return $this->hasOne(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @param array $element | conteudo o objecto a ser enviado
     * @param string $class_name | nome da class example "Livewire.Forms.Cabecalho.ListaCabecalhos"
     * @param string $type | tipo de ação a realizar (Delete, Create, Update)
     * @param $context | Conteudo informativo da acção
     * @return void
     *
     */
    public static function createdActivity(array $element, string $class_name, string $type, $context)
    {
        TaskActivities::create([
            'primavera_email' => auth()->user()->ldap->getEmail(),
            'data_tool_info' => json_encode($element, true),
            'action_info' => $context ,
            'seccion_info' => $type,
            'user_id' => auth()->user()->id,
            'task_identity' => $element['id'],
            'class_name' => $class_name
        ]);
    }


    public static function countMyTascks(): int
    {
        try {

            return self::where('primavera_email', auth()->user()->ldap->getEmail())->count();
        } catch (\Exception $d) {
            return 0;
        }
    }

    public static function myTaskRecentily()
    {
        return self::orderBy('id', 'desc')->get()->take(6);
    }
}
