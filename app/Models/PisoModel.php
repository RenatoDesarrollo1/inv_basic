<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PisoModel extends Model
{
    use HasFactory;

    protected $table = "invent_piso";

    protected $primaryKey = 'idpiso';

    protected $guarded = ['idpiso'];
}
