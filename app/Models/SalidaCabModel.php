<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SalidaCabModel extends Model
{
    use HasFactory;

    protected $table = "invent_salcabecera";

    protected $primaryKey = 'idsalcabecera';

    protected $guarded = ['idsalcabecera'];

    
    public function personal(): HasOne
    {
        return $this->hasOne(PersonalModel::class, 'idpersonal', 'idpersonal');
    }
}
