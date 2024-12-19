<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloModel extends Model
{
    use HasFactory;

    protected $table = "invent_modulo";

    protected $primaryKey = 'idmodulo';

    protected $guarded = ['idmodulo'];
}
