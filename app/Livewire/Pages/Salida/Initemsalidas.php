<?php

namespace App\Livewire\Pages\Salida;

use App\Models\InventarioModel;
use App\Models\PersonalModel;
use App\Models\SalidaDetModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Initemsalidas extends Component
{
    public int $idsalcabecera;
    public int $idsaldetalle;
    public $fecentrada;
    public $personal;
    public $activo;
    public int $idpersonal;
    public int $idinventario;
    public string $observacion;



    #[On('getsalidainitem')]
    public function getData($id = 0, $idsalcabecera = 0)
    {
        $this->idsalcabecera = $idsalcabecera;
        $this->idsaldetalle = 0;
        $this->fecentrada = date('Y-m-d H:i');
        $this->personal = [];
        $this->activo = [];
        $this->idpersonal = 0;
        $this->idinventario = 0;
        $this->observacion = "";

        if ($id != 0 || $idsalcabecera != 0) {
            $saldet = SalidaDetModel::with('activo')->with('personal')->where('idsaldetalle', $id)->first();
            if (isset($saldet->idsaldetalle)) {
                $this->idsaldetalle = $saldet->idsaldetalle;
                $this->fecentrada = $saldet->fecentrada ?? date('Y-m-d H:i');
                $this->activo = $saldet->activo;
                $this->idpersonal = $saldet->idpersonal ?? 0;
                $this->idinventario = $saldet->idinventario ?? 0;
                $this->observacion = $saldet->observacion ?? "";
            }
        }

        $this->idpersonal = 0;
        $personal = PersonalModel::where('estado', 1)->first();
        if (isset($personal->idpersonal)) {
            $this->idpersonal = $personal->idpersonal;
        }
    }



    public function save()
    {
        $this->resetValidation();

        $fecenpar = Carbon::parse($this->fecentrada);
        $this->fecentrada = $fecenpar->format('Y-m-d H:i');


        $validated = $this->validate([
            "fecentrada" => ["required", "date_format:Y-m-d H:i"],
            "idpersonal" => ["required", 'regex:/^[1-9][0-9]*$/'],
            "observacion" => ["nullable"],
        ], [
            'idpersonal.required' => "El personal es requerido",
            'idpersonal.regex' => "El personal es requerido",
        ]);

        try {
            DB::beginTransaction();
            SalidaDetModel::where('idsaldetalle', $this->idsaldetalle)->update($validated);
            InventarioModel::where('idinventario', $this->idinventario)->update(['idsalcabecera' => null]);

            DB::commit();

            $this->dispatch('close-modal', 'initemsalidas');
            $this->dispatch('getsalidain', id: $this->idsalcabecera);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.pages.salida.initemsalidas');
    }
}
