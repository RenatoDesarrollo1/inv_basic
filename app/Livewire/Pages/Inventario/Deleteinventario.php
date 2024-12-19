<?php

namespace App\Livewire\Pages\Inventario;

use App\Models\InventarioModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Deleteinventario extends Component
{

    public int $idinventario;

    #[On('getdelete')]
    public function getEliminar($id)
    {
        $this->idinventario = $id;
    }

    public function eliminar()
    {
        if (InventarioModel::where('idinventario', $this->idinventario)->exists()) {


            InventarioModel::where('idinventario', $this->idinventario)->delete();
        }


        $this->dispatch('close-modal', 'deleteinventario');
        $this->dispatch('inventario-submitted');
    }

    public function render()
    {
        return view('livewire.pages.inventario.deleteinventario');
    }
}
