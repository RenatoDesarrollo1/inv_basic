<?php

namespace App\Livewire\Pages\Inventario;

use App\Models\InventarioModel;
use App\Models\PersonalModel;
use App\Models\SalidaCabModel;
use App\Models\SalidaDetModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;

class Salidainventario extends Component
{
    public $inventariogroup = [];
    public $fecemision;
    public int $idpersonal;
    public string $observacion;



    #[On('getdatasalida')]
    public function getData($data = [])
    {

        $this->fecemision = date('Y-m-d H:i');

        $this->idpersonal = 0;
        $personal = PersonalModel::first();
        if (isset($personal->idpersonal)) {
            $this->idpersonal = $personal->idpersonal;
        }

        $this->observacion = "";
        $this->inventariogroup = $data;

        $this->dispatch('open-modal', 'salidainventario');
    }


    public function save()
    {
        $this->resetValidation();

        $fecempar = Carbon::parse($this->fecemision);
        $this->fecemision = $fecempar->format('Y-m-d H:i');


        $validated = $this->validate([
            "fecemision" => ["required", "date_format:Y-m-d H:i"],
            "idpersonal" => ["required", 'regex:/^[1-9][0-9]*$/'],
            "observacion" => ["nullable"],
        ], []);


        $datacab = collect($this->only('fecemision', 'idpersonal', 'observacion'))->all();

        try {
            DB::beginTransaction();
            $salidacab = SalidaCabModel::create($datacab);

            if (isset($salidacab->idsalcabecera)) {
                $salidadet = [];

                foreach ($this->inventariogroup as $value) {

                    if (!isset($value['idsalcabecera'])) {
                        $salidadet[] = [
                            "idsalcabecera" => $salidacab->idsalcabecera,
                            "idinventario" => $value['idinventario']
                        ];
                    }
                }
                if (count($salidadet) > 0) {
                    SalidaDetModel::insert($salidadet);

                    $salidadetid = [];
                    foreach ($salidadet as $value) {

                        $salidadetid[] = $value['idinventario'];
                    }
                    if (count($salidadetid) > 0) {
                        InventarioModel::whereIn('idinventario', $salidadetid)->update(['idsalcabecera' =>  $salidacab->idsalcabecera]);
                    }

                    DB::commit();
 
                    $this->getData();
                    $this->dispatch('close-modal', 'salidainventario');
                    $this->dispatch('inventario-submitted');
                } else {
                    DB::rollBack();
                    throw ValidationException::withMessages([
                        'observacion' => 'No existen activos para la salida'
                    ]);
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
        return view('livewire.pages.inventario.salidainventario');
    }
}
