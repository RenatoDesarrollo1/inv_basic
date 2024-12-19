<?php

namespace App\Livewire\Pages\Inventario;

use App\Models\InventarioModel;
use App\PDFgen\PDFgen;
use Livewire\Component;
use Livewire\Attributes\On;

class Etinventario extends Component
{
    public $data = [];
    public int $start;

    public function mount()
    {

        $this->start = 1;
    }

    #[On('getdataet')]
    public function getData($nombre, $filtro, $orders)
    {
        $inventario = InventarioModel::select(
            'invent_inventario.*',
            'invent_categoria.nombre as nombrecategoria',
            'invent_local.nombre as nombrelocal',
            'invent_piso.nombre as nombrepiso',
            'invent_ambiente.nombre as nombreambiente',
            'invent_paredes.nombre as nombrepared',
            'invent_modulo.nombre as nombremodulo',
            'fa1.nombre as nombrefa1',
            'fa2.nombre as nombrefa2',
            'fa3.nombre as nombrefa3',
            'fa4.nombre as nombrefa4',
            'fa5.nombre as nombrefa5'
        )
            ->leftJoin('invent_local', 'invent_inventario.idlocal', '=', 'invent_local.idlocal')
            ->leftJoin('invent_piso', 'invent_inventario.idpiso', '=', 'invent_piso.idpiso')
            ->leftJoin('invent_ambiente', 'invent_inventario.idambiente', '=', 'invent_ambiente.idambiente')
            ->leftJoin('invent_paredes', 'invent_inventario.idpared', '=', 'invent_paredes.idpared')
            ->leftJoin('invent_modulo', 'invent_inventario.idmodulo', '=', 'invent_modulo.idmodulo')
            ->leftJoin('invent_fondoalto1 as fa1', 'invent_inventario.idfondoalto1', '=', 'fa1.idfondoalto')
            ->leftJoin('invent_fondoalto as fa2', 'invent_inventario.idfondoalto2', '=', 'fa2.idfondoalto')
            ->leftJoin('invent_fondoalto as fa3', 'invent_inventario.idfondoalto3', '=', 'fa3.idfondoalto')
            ->leftJoin('invent_fondoalto as fa4', 'invent_inventario.idfondoalto4', '=', 'fa4.idfondoalto')
            ->leftJoin('invent_fondoalto as fa5', 'invent_inventario.idfondoalto5', '=', 'fa5.idfondoalto')
            ->leftJoin('invent_categoria', 'invent_inventario.idcategoria', '=', 'invent_categoria.idcategoria');

        if ($nombre != "") {
            $inventario = $inventario->where("invent_inventario.nombre", 'LIKE', "{$nombre}%")->orWhere("invent_inventario.codigoalm", 'LIKE', "{$nombre}%")->orWhere("invent_inventario.codigoprod", 'LIKE', "{$nombre}%");
        }
        foreach ($filtro as $key => $value) {
            if (count($value) > 0) {
                $inventario = $inventario->whereIn($key, $value);
            }
        }

        if (count($orders) > 0) {
            foreach ($orders as $key => $value) {
                $inventario = $inventario->orderBy($key, $value);
            }
        }

        $inventario = $inventario->take(100)->get()->toArray();

        $this->data = $inventario;
        $this->dispatch('open-modal', 'etinventario');
    }

    public function save()
    {

        $pdfgen = new PDFgen();

        $date = getdate()[0];

        $name = "et{$date}";

        $pdfgen->et3barcodeinv($this->data, $this->start, $name);


        return response()->download(
            storage_path("app/pdf/{$name}.pdf")
        )->deleteFileAfterSend();
    }


    public function render()
    {
        return view('livewire.pages.inventario.etinventario');
    }
}
