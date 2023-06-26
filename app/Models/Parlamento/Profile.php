<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Profile
 * @package App\Models
 * @version June 15, 2022, 10:08 am UTC
 *
 * @property string $primavera_email
 * @property string $data_tool_info
 * @property string $image_profile
 * @property integer $user_id
 * @property integer $order
 */
class Profile extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.Profile';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'primavera_email',
        'data_tool_info',
        'image_profile',
        'user_id',
        'order'
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
        'image_profile' => 'string',
        'user_id' => 'integer',
        'order' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'primavera_email' => 'nullable|string',
        'data_tool_info' => 'nullable|string',
        'image_profile' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'order' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
