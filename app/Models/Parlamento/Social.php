<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Social
 * @package App\Models
 * @version July 18, 2022, 11:25 am UTC
 *
 * @property string $href
 * @property string $icon
 * @property integer $user_id
 * @property integer $aboutSection
 * @property integer $deputy_id
 */
class Social extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.social';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'href',
        'icon',
        'user_id',
        'aboutSection',
        'deputy_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'href' => 'string',
        'icon' => 'string',
        'user_id' => 'integer',
        'aboutSection' => 'integer',
        'deputy_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'href' => 'required|string',
        'icon' => 'required|string',
        'user_id' => 'required|integer',
        'aboutSection' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'deputy_id' => 'nullable'
    ];




}
