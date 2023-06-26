<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Solutionssection
 * @package App\Models
 * @version February 22, 2022, 7:57 pm UTC
 *
 * @property string $title
 * @property string $context
 * @property integer $user_id
 */
class Solutionssection extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.solutionssection';

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
        'title' => 'nullable|string',
        'context' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function listSection()
    {
        return $this->hasMany(Listsection::class, 'SolutionsSection_id')->latest();
    }

    public function figure()
    {
        return $this->hasOne(Figure::class, 'SolutionsSection_id')->latest();
    }

    public function images()
    {
        return $this->hasMany(Figure::class, 'image_id')->latest();
    }

    public function clearfix()
    {
        return $this->hasOne(Clearfix::class, 'SolutionsSection_id')->latest();
    }

}
