<?php

namespace App\Models\Parlamento;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\File;

/**
 * Class LinkFiles
 * @package App\Models
 * @version June 23, 2022, 12:06 pm UTC
 *
 * @property string $fileName
 * @property string $path
 * @property string $dataObject
 * @property string $context
 * @property integer $order
 * @property integer $parentId
 * @property string $parentName
 * @property integer $user_id
 */
class LinkFiles extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'Parlamento.linkFiles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "Parlamento";

    public $fillable = [
        'fileName',
        'path',
        'dataObject',
        'context',
        'order',
        'parentId',
        'parentName',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fileName' => 'string',
        'path' => 'string',
        'dataObject' => 'string',
        'context' => 'string',
        'order' => 'integer',
        'parentId' => 'integer',
        'parentName' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fileName' => 'nullable|string',
        'path' => 'nullable|string',
        'dataObject' => 'nullable|string',
        'context' => 'nullable|string',
        'order' => 'nullable',
        'parentId' => 'nullable',
        'parentName' => 'nullable|string|max:200',
        'user_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static function saveAnexo($data, array $logs)
    {
        try {
            LinkFiles::create([
                'fileName' => $data->getClientOriginalName(),
                'path' => $data->store('notices/anexos', 'public'),
                'dataObject' => json_encode($logs, true),
                'context' => 'Noticias',
                'parentId' => $logs['id'],
                'parentName' => 'Blogpag',
                'user_id' => auth()->user()->id
            ]);
        } catch (\Exception $d) {

        }

    }

}
