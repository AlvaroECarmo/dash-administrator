<?php

namespace App\Models\Parlamento;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mainheader
 * @package App\Models
 * @version February 22, 2022, 7:56 pm UTC
 *
 * @property string $date_region
 * @property string $icon_region
 * @property integer $user_id
 */
class Mainheader extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.mainheader';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'date_region',
        'icon_region',
        'user_id',
        'status',
        'order',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_region' => 'string',
        'icon_region' => 'string',
        'user_id' => 'integer',
        'status' => 'boolean',
        'email' => 'string',
        'order' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date_region' => 'required|string',
        'icon_region' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'status' => 'nullable|boolean',
        'email' => 'nullable|boolean',
        'order' => 'nullable',
    ];


    public function socialitesList()
    {
        return $this->hasMany(Headercontent::class, 'socialitesList')->latest()->take(4);
    }

    public function inforList()
    {
        return $this->hasMany(Headercontent::class, 'inforList')->latest()->take(2);
    }

    public function linksBox()
    {
        return $this->hasMany(Headercontent::class, 'linksBox')->latest()->take(3);
    }

    public function listLange()
    {
        return $this->hasMany(Headercontent::class, 'listLange')->take(5);
    }



    public function listaItengracoes($selected = null)
    {

        switch ($selected) {
            case 'socialitesList':
                return Headercontent::where('socialitesList', $this->id)->get();
            case 'inforList':
                return Headercontent::where('inforList', $this->id)->get();
            case 'linksBox':
                return Headercontent::where('linksBox', $this->id)->get();
            case 'listLange':
                return Headercontent::where('listLange', $this->id)->get();
            default:
                return Headercontent::all();
        }
    }

    public static function activitiesUsers($id, string $className)
    {
        return TaskActivities::where('class_name', $className)
            //->where('task_identity', $id)
            ->distinct()
            ->get(['user_id', 'primavera_email'])->take(4);

    }
}
