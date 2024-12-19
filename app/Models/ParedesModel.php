<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParedesModel extends Model
{
    use HasFactory;

    protected $table = "invent_paredes";

    protected $primaryKey = 'idpared';

    protected $guarded = ['idpared'];
}
