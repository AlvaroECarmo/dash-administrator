<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class GeradoreMigrator extends Model
{

    public static function gerar()
    {
        dump('ola');
     /*   $rules = [
            'title' => 'required|string|max:500',
            'subTitle' => 'required|string|max:500',
            'h5' => 'required|string',
            'h4' => 'nullable|string',
            'p' => 'nullable|string',
            'user_id' => 'nullable|integer'
        ];


        file_put_contents(base_path('database/migrations/Testar.php'), $rules);*/
    }

}



