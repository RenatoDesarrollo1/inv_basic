<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SalidaDetModel extends Model
{
    use HasFactory;

    protected $table = "invent_saldetalle";

    protected $primaryKey = 'idsaldetalle';

    protected $guarded = ['idsaldetalle'];

    public function activo(): HasOne
    {
        return $this->hasOne(InventarioModel::class, 'idinventario', 'idinventario');
    }

    public function personal(): HasOne
    {
        return $this->hasOne(PersonalModel::class, 'idpersonal', 'idpersonal');
    }
}
