<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InventarioModel extends Model
{
    use HasFactory;

    protected $table = "invent_inventario";

    protected $primaryKey = 'idinventario';

    protected $guarded = ['idinventario'];


    
    public function local(): HasOne
    {
        return $this->hasOne(LocalModel::class, 'idlocal', 'idlocal');
    }
    
    public function ambiente(): HasOne
    {
        return $this->hasOne(AmbienteModel::class, 'idambiente', 'idambiente');
    }

    public function categoria(): HasOne
    {
        return $this->hasOne(CategoriaModel::class, 'idcategoria', 'idcategoria');
    }

    public function salcabecera(): HasOne
    {
        return $this->hasOne(SalidaCabModel::class, 'idsalcabecera', 'idsalcabecera');
    }

    public $timestamps = false;
}
