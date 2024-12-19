<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
    use HasFactory;

    protected $table = "invent_categoria";

    protected $primaryKey = 'idcategoria';

    protected $guarded = ['idcategoria'];
}
