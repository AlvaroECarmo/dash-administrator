<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VideoYoutube
 * @package App\Models
 * @version May 10, 2022, 6:43 pm UTC
 *
 * @property string $title
 * @property string $ifram
 * @property string $context
 * @property string $details
 * @property string $src
 */
class VideoYoutube extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.videoYoutube';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'title',
        'ifram',
        'context',
        'details',
        'src'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'ifram' => 'string',
        'context' => 'string',
        'details' => 'string',
        'src' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'ifram' => 'required|string',
        'context' => 'required|string',
        'details' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'src' => 'nullable|string'
    ];

    public static function isPublishd($attr)
    {
        return (bool)self::where('ifram', $attr)->first();
    }

    public static function isEstaque($attr)
    {
        $date1 = self::orderBy('id', 'desc')->first();
        $data2 = self::where('ifram', $attr['id']['videoId'])->first();

        if ($date1 && $data2) {
            return ($date1->ifram == $data2->ifram);
        }

        return false;
    }


}
