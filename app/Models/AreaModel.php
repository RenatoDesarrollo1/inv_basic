<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaModel extends Model
{
    use HasFactory;

    protected $table = "invent_area";

    protected $primaryKey = 'idarea';

    protected $guarded = ['idarea'];
}
