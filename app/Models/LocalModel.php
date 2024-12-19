<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalModel extends Model
{
    use HasFactory;

    protected $table = "invent_local";

    protected $primaryKey = 'idlocal';

    protected $guarded = ['idlocal'];
}
