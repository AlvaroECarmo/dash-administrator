<?php

namespace App\Models\Comuns;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $connection = 'ConnectionName';
    protected $table = 'SchemaName.Groups';

    protected $fillable = ['web', 'name', 'observation'];





}
