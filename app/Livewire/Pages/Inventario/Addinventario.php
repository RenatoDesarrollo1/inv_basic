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
use Livewire\Component;

class Addinventario extends Component
{
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

    public function isAdmin()
    {
        return boolval(Auth::user()->isadmin);
    }

    public function getData() {
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

        $local = LocalModel::first();
        $this->idlocal = $local?->idlocal;

        $piso = PisoModel::first();
        $this->idpiso = $piso?->idpiso;

        $ambiente = AmbienteModel::first();
        $this->idambiente = $ambiente?->idambiente;

        $pared = ParedesModel::first();
        $this->idpared = $pared?->idpared;

        $modulo = ModuloModel::first();
        $this->idmodulo = $modulo?->idmodulo;

        $fondoalto = FondoaltoModel::first();
        $fondoalto1 = FondoaltoModel1::first();
        $this->idfondoalto1 = $fondoalto1?->idfondoalto;
        $this->idfondoalto2 = $fondoalto?->idfondoalto;
        $this->idfondoalto3 = $fondoalto?->idfondoalto;
        $this->idfondoalto4 = $fondoalto?->idfondoalto;
        $this->idfondoalto5 = $fondoalto?->idfondoalto;
    }

    public function mount()
    {
        $this->getData();
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

        $ultimoactivo = InventarioModel::orderBy('codigo', 'DESC')->first();
        $this->codigo = str_pad(intval($ultimoactivo?->codigo) + 1, 6, "0", STR_PAD_LEFT);

        $data = collect($this->all())->all();

        foreach ($data as $key => &$value) {
            if (trim($value) === "") {
                $data[$key] = null;
            }
        }

        InventarioModel::create($data);

        $this->reset();
        $this->codigo = "";
        $this->cantidad = "1";
        $this->piezas = "";
        $this->estado = "1";
        $this->getData();
        $this->dispatch('close-modal', 'addinventario');
        $this->dispatch('inventario-submitted');
    }

    public function render()
    {
        return view('livewire.pages.inventario.addinventario');
    }
}
