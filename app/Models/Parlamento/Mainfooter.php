<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mainfooter
 * @package App\Models
 * @version February 22, 2022, 7:56 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property integer $user_id
 */
class Mainfooter extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.mainfooter';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'context',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'context' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:45',
        'context' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function gruParliamentary()
    {
        return $this->hasMany(Contentdescription::class, 'gruParliamentary')->latest()->take(5);

    }

    public function location()
    {
        return $this->hasMany(Contentdescription::class, 'location')->latest()->take(1);
    }

    public function responsible()
    {
        return $this->hasMany(Contentdescription::class, 'responsible')->latest()->take(2);

    }

}