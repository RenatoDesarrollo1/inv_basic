<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FondoaltoModel extends Model
{
    use HasFactory;

    protected $table = "invent_fondoalto";

    protected $primaryKey = 'idfondoalto';

    protected $guarded = ['idfondoalto'];
}
