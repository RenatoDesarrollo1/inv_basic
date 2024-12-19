<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalModel extends Model
{
    use HasFactory;

    protected $table = "invent_personal";

    protected $primaryKey = 'idpersonal';

    protected $guarded = ['idpersonal'];
}
