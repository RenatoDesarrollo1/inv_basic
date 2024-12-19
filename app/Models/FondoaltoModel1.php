<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FondoaltoModel1 extends Model
{
    use HasFactory;

    protected $table = "invent_fondoalto1";

    protected $primaryKey = 'idfondoalto';

    protected $guarded = ['idfondoalto'];
}
