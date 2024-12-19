<?php

namespace App\Livewire\Pages\Inventario;

use App\Models\AmbienteModel;
use App\Models\FondoaltoModel;
use App\Models\FondoaltoModel1;
use App\Models\LocalModel;
use App\Models\ModuloModel;
use App\Models\ParedesModel;
use App\Models\PisoModel;
use App\Models\InventarioModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Editinventario extends Component
{
    public string $idinventario;
    public string $codigo;
    public string $codigoubi;
    public string $idcategoria;
    public string $idlocal;
    public string $idpiso;
    public string $idambiente;
    public string $idpared;
    public string $idmodulo;
    public string $idfondoalto1;
    public string $idfondoalto2;
    public string $idfondoalto3;
    public string $idfondoalto4;
    public string $idfondoalto5;
    public string $piezas;
    public string $nombre;
    public string $cantidad;
    public string $marca;
    public string $modelo;
    public string $ram;
    public string $procesador;
    public string $disco;
    public string $serie;
    public string $descripcion;
    public string $dimensiones;
    public string $codigoanterior;
    public string $precioc;
    public string $preciov;
    public string $proveedor;
    public string $nrofactura;
    public string $fecfactura;
    public string $estado;



    public function mount()
    {

        $this->codigo = "";
        $this->codigoubi = "";
        $this->idcategoria = "";
        $this->idlocal = "";
        $this->idpiso = "";
        $this->idambiente = "";
        $this->idpared = "";
        $this->idmodulo = "";
        $this->idfondoalto1 = "";
        $this->idfondoalto2 = "";
        $this->idfondoalto3 = "";
        $this->idfondoalto4 = "";
        $this->idfondoalto5 = "";
        $this->piezas = "";
        $this->nombre = "";
        $this->cantidad = "1";
        $this->marca = "";
        $this->modelo = "";
        $this->ram = "";
        $this->procesador = "";
        $this->disco = "";
        $this->serie = "";
        $this->descripcion = "";
        $this->dimensiones = "";
        $this->codigoanterior = "";
        $this->precioc = "";
        $this->preciov = "";
        $this->proveedor = "";
        $this->nrofactura = "";
        $this->fecfactura = "";
        $this->estado = 1;
    }

    #[On('getinventario')]
    public function getInventario($id)
    {
        $local = LocalModel::first();
        $piso = PisoModel::first();
        $ambiente = AmbienteModel::first();
        $pared = ParedesModel::first();
        $modulo = ModuloModel::first();
        $fondoalto = FondoaltoModel::first();
        $fondoalto1 = FondoaltoModel1::first();

        $inventario = InventarioModel::where('idinventario', $id)->first();
        if (isset($inventario->idinventario)) {
            $this->idinventario = $inventario->idinventario;
            $this->codigo = $inventario->codigo ?? "";
            $this->codigoubi = $inventario->codigoubi ?? "";
            $this->idcategoria = $inventario->idcategoria ?? "";
            $this->idlocal = $inventario->idlocal ?? $local?->idlocal;
            $this->idpiso = $inventario->idpiso ?? $piso?->idpiso;
            $this->idambiente = $inventario->idambiente ?? $ambiente?->idambiente;
            $this->idpared = $inventario->idpared ?? $pared?->idpared;
            $this->idmodulo = $inventario->idmodulo ?? $modulo?->idmodulo;
            $this->idfondoalto1 = $inventario->idfondoalto1 ?? $fondoalto1?->idfondoalto;
            $this->idfondoalto2 = $inventario->idfondoalto2 ?? $fondoalto?->idfondoalto;
            $this->idfondoalto3 = $inventario->idfondoalto3 ?? $fondoalto?->idfondoalto;
            $this->idfondoalto4 = $inventario->idfondoalto4 ?? $fondoalto?->idfondoalto;
            $this->idfondoalto5 = $inventario->idfondoalto5 ?? $fondoalto?->idfondoalto;
            $this->piezas = $inventario->piezas ?? "";
            $this->nombre = $inventario->nombre ?? "";
            $this->cantidad = $inventario->cantidad ?? "";
            $this->marca = $inventario->marca ?? "";
            $this->modelo = $inventario->modelo ?? "";
            $this->ram = $inventario->ram ?? "";
            $this->procesador = $inventario->procesador ?? "";
            $this->disco = $inventario->disco ?? "";
            $this->serie = $inventario->serie ?? "";
            $this->descripcion = $inventario->descripcion ?? "";
            $this->dimensiones = $inventario->dimensiones ?? "";
            $this->codigoanterior = $inventario->codigoanterior ?? "";
            $this->precioc = $inventario->precioc ?? "";
            $this->preciov = $inventario->preciov ?? "";
            $this->proveedor = $inventario->proveedor ?? "";
            $this->nrofactura = $inventario->nrofactura ?? "";
            $this->fecfactura = $inventario->fecfactura ?? "";
            $this->estado = $inventario->estado ?? "";

            $this->dispatch('open-modal', 'editinventario');
        }
    }


    public function updated($property, $value)
    {

        if ($property == "cantidad") {
            if ($value == "") {
                $this->cantidad = "1";
            }
        }

        if ($property == "estado") {
            if ($value == "") {
                $this->estado = "1";
            }
        }
    }

    public function save()
    {


        $this->piezas = trim($this->piezas) == "" ? 0 : trim($this->piezas);


        $validated = $this->validate([
            "nombre" => ["required"],
            "piezas" => ["nullable", "numeric", "max:99"],
        ], [
            'nombre.required' => "El nombre es requerido",
            'piezas.max' => "El número máximo de piezas es 99",
        ]);

        $codlocal = LocalModel::where('idlocal', $this->idlocal)->first()?->cod ?? "0";

        $codpiso = PisoModel::where('idpiso', $this->idpiso)->first()?->cod ?? "0";

        $codambiente = AmbienteModel::where('idambiente', $this->idambiente)->first()?->cod ?? "00";

        $codpared = ParedesModel::where('idpared', $this->idpared)->first()?->cod ?? "0";

        $codmodulo = ModuloModel::where('idmodulo', $this->idmodulo)->first()?->cod ?? "0";

        $codfondoalto1 = FondoaltoModel1::where('idfondoalto', $this->idfondoalto1)->first()->cod ?? "0";
        $codfondoalto2 = FondoaltoModel::where('idfondoalto', $this->idfondoalto2)->first()->cod ?? "0";
        $codfondoalto3 = FondoaltoModel::where('idfondoalto', $this->idfondoalto3)->first()->cod ?? "0";
        $codfondoalto4 = FondoaltoModel::where('idfondoalto', $this->idfondoalto4)->first()->cod ?? "0";
        $codfondoalto5 = FondoaltoModel::where('idfondoalto', $this->idfondoalto5)->first()->cod ?? "0";

        $codpieza = str_pad(intval($this->piezas), 2, "0", STR_PAD_LEFT);

        $this->codigoubi = $codlocal . $codpiso . $codambiente . $codpared . $codmodulo . $codfondoalto1 . $codfondoalto2 . $codfondoalto3 . $codfondoalto4 . $codfondoalto5 . $codpieza;


        $data = collect($this->all())->all();

        foreach ($data as $key => &$value) {
            if (trim($value) === "") {
                $data[$key] = null;
            }
        }
        InventarioModel::where('idinventario', $this->idinventario)->update($data);

        $this->reset();
        $this->codigo = "";
        $this->codigoubi = "";
        $this->cantidad = "1";
        $this->piezas = "";
        $this->estado = "1";
        $this->dispatch('close-modal', 'editinventario');
        $this->dispatch('inventario-submitted');
    }
    public function render()
    {
        return view('livewire.pages.inventario.editinventario');
    }
}
