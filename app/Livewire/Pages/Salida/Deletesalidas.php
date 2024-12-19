<?php

namespace App\Livewire\Pages\Salida;

use App\Models\SalidaCabModel;
use App\Models\SalidaDetModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Deletesalidas extends Component
{
    public int $idsalcabecera;

    #[On('getsalidadelete')]
    public function getData($id = 0)
    {
        $this->idsalcabecera = $id;
    }

    public function delete()
    {
        try {
            DB::beginTransaction();

            if (SalidaCabModel::where('idsalcabecera', $this->idsalcabecera)->delete()) {
                if (SalidaDetModel::where('idsalcabecera', $this->idsalcabecera)->delete()) {
                    DB::commit();

                    $this->getData();
                    $this->dispatch('close-modal', 'deletesalidas');
                    $this->dispatch('salida-submitted');
                } else {
                    DB::rollBack();
                }
            } else {
                DB::rollBack();
            }
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.pages.salida.deletesalidas');
    }
}
