<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ActivoModel extends Model
{
    use HasFactory;

    protected $table = "invent_activos";

    protected $primaryKey = 'idactivo';

    protected $guarded = ['idactivo'];

    public function salcabecera(): HasOne
    {
        return $this->hasOne(SalidaCabModel::class, 'idsalcabecera', 'idsalcabecera');
    }
}
