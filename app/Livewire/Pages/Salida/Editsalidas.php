<?php

namespace App\Livewire\Pages\Salida;

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

class Editsalidas extends Component
{
    public int $idsalcabecera;
    public $activo = [];
    public $fecemision;
    public int $idpersonal;
    public string $observacion;
    public $estado;

    #[On('getsalida')]
    public function getData($id = 0)
    {
        $this->idsalcabecera = 0;
        $this->activo = [];
        $this->fecemision = date('Y-m-d H:i');
        $this->idpersonal = 0;
        $personal = PersonalModel::first();
        if (isset($personal->idpersonal)) {
            $this->idpersonal = $personal->idpersonal;
        }
        $this->observacion = "";
        $this->estado = true;

        if ($id != 0) {
            $salcab = SalidaCabModel::where('idsalcabecera', $id)->first();

            if (isset($salcab->idsalcabecera)) {
                $this->idsalcabecera = $salcab->idsalcabecera;
                $this->fecemision = $salcab->fecemision;
                $this->idpersonal = $salcab->idpersonal;
                $this->observacion = $salcab->observacion ?? "";

                $saldet = SalidaDetModel::where('idsalcabecera', $id)->get()->toArray();

                $saldetid = [];

                foreach ($saldet as $value) {
                    $saldetid[] = $value['idinventario'];
                }

                $this->activo = InventarioModel::select('idinventario', 'codigo', 'nombre', 'idsalcabecera')->whereIn('idinventario', $saldetid)->get()->toArray();
            }
        }
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
            "estado" => ["required", "boolean"],
        ], [
            'idpersonal.required' => "El personal es requerido",
            'idpersonal.regex' => "El personal es requerido",
        ]);

        try {
            DB::beginTransaction();

            SalidaCabModel::where('idsalcabecera', $this->idsalcabecera)->update($validated);

            if ($this->estado) {

                $salidadetid = [];
                foreach ($this->activo as $value) {

                    $salidadetid[] = $value['idinventario'];
                }
                if (count($salidadetid) > 0) {
                    InventarioModel::whereIn('idinventario', $salidadetid)->update(['idsalcabecera' =>  $this->idsalcabecera]);
                }
            }
            DB::commit();
            $this->getData();
            $this->dispatch('close-modal', 'editsalidas');
            $this->dispatch('salida-submitted');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
    public function render()
    {
        return view('livewire.pages.salida.editsalidas');
    }
}
