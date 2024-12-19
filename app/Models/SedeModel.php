<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SedeModel extends Model
{
    use HasFactory;

    protected $table = "invent_sede";

    protected $primaryKey = 'idsede';

    protected $guarded = ['idsede'];
}
