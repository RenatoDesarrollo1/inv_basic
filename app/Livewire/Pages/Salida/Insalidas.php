<?php

namespace App\Livewire\Pages\Salida;

use App\Models\InventarioModel;
use App\Models\SalidaCabModel;
use App\Models\SalidaDetModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Insalidas extends Component
{
    public int $idsalcabecera;
    public $detalle = [];
    public $fecemision;
    public int $idpersonal;
    public $personal;
    public string $observacion;
    public $estado;


    #[On('getsalidain')]
    public function getData($id = 0)
    {
        $this->idsalcabecera = 0;
        $this->detalle = [];
        $this->fecemision = date('Y-m-d H:i');
        $this->idpersonal = 0;
        $this->personal = [];
        $this->observacion = "";
        $this->estado = false;

        if ($id != 0) {
            $salcab = SalidaCabModel::with('personal')->where('idsalcabecera', $id)->first();

            if (isset($salcab->idsalcabecera)) {
                $this->idsalcabecera = $salcab->idsalcabecera;
                $this->fecemision = $salcab->fecemision;
                $this->idpersonal = $salcab->idpersonal;
                $this->personal = $salcab->personal;
                $this->observacion = $salcab->observacion ?? "";
                $this->estado = $salcab->estado;

                $this->detalle = SalidaDetModel::with('activo')->with('personal')->where('idsalcabecera', $id)->get();
            }
        }
    }


    public function openModalInItem($id)
    {
        $this->dispatch('open-modal', 'initemsalidas');
        $this->dispatch('getsalidainitem', id: $id, idsalcabecera: $this->idsalcabecera);
    }

    public function render()
    {
        return view('livewire.pages.salida.insalidas');
    }
}
