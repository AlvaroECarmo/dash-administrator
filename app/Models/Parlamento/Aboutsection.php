<?php

namespace App\Models\Parlamento;

use \Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Aboutsection
 * @package App\Models
 * @version February 22, 2022, 7:51 pm UTC
 *
 * @property string $title
 * @property string $subTitle
 * @property string $h5
 * @property string $h4
 * @property string $p
 * @property integer $user_id
 */
class Aboutsection extends Model
{
    use SoftDeletes;

    public $table = 'Parlamento.aboutsection';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'subTitle',
        'h5',
        'h4',
        'p',
        'user_id',
        'order',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'subTitle' => 'string',
        'h5' => 'string',
        'h4' => 'string',
        'p' => 'string',
        'user_id' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:500',
        'subTitle' => 'required|string|max:500',
        'h5' => 'required|string',
        'h4' => 'nullable|string',
        'p' => 'nullable|string',
        'user_id' => 'nullable|integer',
        'order' => 'nullable|integer',
    ];

    public function social()
    {
        return $this->hasMany(Social::class, 'aboutSection', 'id')->latest();
    }

    public function lowerBox()
    {
        return $this->hasMany(LowerBox::class, 'aboutSection_id', 'id')->latest()->take(2);
    }

    public function imageBox()
    {
        return $this->hasOne(ImageBox::class, 'aboutSection_id', 'id')->orderBy('id', 'desc');
    }


}
