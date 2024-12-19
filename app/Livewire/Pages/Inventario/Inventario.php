<?php

namespace App\Livewire\Pages\Inventario;

use App\Models\InventarioModel;
use App\Report\ReportExcel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Inventario')]
class Inventario extends Component
{
    use WithPagination;

    public string $tab;
    public string $nombre;
    public $filtro = [];
    public $orders = ["codigo" => "ASC"];
    public $inventariogroup = [];



    public function mount()
    {
        $this->nombre = "";
        $this->tab = "activos";
    }

    public function setTab($value)
    {
        $this->tab = $value;
    }



    public function validateGroup($id)
    {
        foreach ($this->inventariogroup as $item) {
            if ($item['idinventario'] == $id) {
                return true;
            }
        }
    }

    public function addGroup($id)
    {
        $item = InventarioModel::where('idinventario', $id)->with('categoria')->first()->toArray();

        $isInGroup = false;

        foreach ($this->inventariogroup as $iteminv) {
            if ($iteminv['idinventario'] == $item['idinventario']) {
                $isInGroup = true;
                return;
            }
        }
        if (!$isInGroup) {
            $this->inventariogroup[] = $item;
        }
    }

    public function deleteGroup($key)
    {
        unset($this->inventariogroup[$key]);

        $this->inventariogroup = array_values($this->inventariogroup);
    }

    public function openModalEt()
    {
        $this->dispatch('getdataet', nombre: $this->nombre, filtro: $this->filtro, orders: $this->orders);
    }

    public function openModalEtgroup()
    {
        $this->dispatch('getdata', data: $this->inventariogroup);
    }

    public function openModalSalgroup()
    {

        $invsal = [];


        foreach ($this->inventariogroup as $value) {
            if (!isset($value['idsalcabecera'])) {
                $invsal[] = $value['idinventario'];
            }
        }

        $inventsal = InventarioModel::select('idinventario', 'codigo', 'nombre', 'idsalcabecera')->whereIn('idinventario', $invsal)->whereNull('idsalcabecera')->get()->toArray();

        $this->dispatch('getdatasalida', data: $inventsal);
    }


    public function openModalEdit($id)
    {
        $this->dispatch('getinventario', id: $id);
    }

    public function openModalDelete($id)
    {
        $this->dispatch('open-modal', 'deleteinventario');
        $this->dispatch('getdelete', id: $id);
    }

    #[On('inventario-filtro')]
    public function updateFilro($field, $value)
    {
        $this->setPage(1);
        $this->filtro[$field] = $value;
    }

    public function validateOrder($field)
    {
        if (isset($this->orders[$field])) {
            if ($this->orders[$field] == "ASC") {
                return "↑";
            } else if ($this->orders[$field] == "DESC") {
                return "↓";
            } else {

                return "";
            }
        } else {
            return "";
        }
    }

    public function addOrder($field)
    {
        if (isset($this->orders[$field])) {
            if ($this->orders[$field] == 'ASC') {
                unset($this->orders[$field]);
                $this->orders[$field] =  'DESC';
            } else if ($this->orders[$field] == 'DESC') {
                unset($this->orders[$field]);
            }
        } else {
            $this->orders[$field] =  'ASC';
        }
    }

    public function genExcel()
    {
        $pdfgen = new ReportExcel();

        $date = getdate()[0];

        $name = "advreporteexcel{$date}";

        $pdfgen->report($this->filtro, $this->orders, $this->nombre, $name);


        return response()->download(
            storage_path("app/excel/{$name}.xlsx")
        )->deleteFileAfterSend();
    }



    #[On('inventario-submitted')]
    public function render()
    {
        $inventario = InventarioModel::select('invent_inventario.*', 'invent_categoria.nombre as nombrecategoria', 'invent_local.nombre as nombrelocal', 'invent_ambiente.nombre as nombreambiente')
            ->leftJoin('invent_categoria', 'invent_inventario.idcategoria', '=', 'invent_categoria.idcategoria')
            ->leftJoin('invent_local', 'invent_inventario.idlocal', '=', 'invent_local.idlocal')
            ->leftJoin('invent_ambiente', 'invent_inventario.idambiente', '=', 'invent_ambiente.idambiente');

        if ($this->nombre != "") {
            $this->setPage(1);
            $inventario = $inventario->where("invent_inventario.nombre", 'LIKE', "{$this->nombre}%")->orWhere("invent_inventario.codigo", 'LIKE', "%{$this->nombre}%");
        }
        foreach ($this->filtro as $key => $value) {
            if (count($value) > 0) {
                $inventario = $inventario->whereIn($key, $value);
            }
        }

        if (count($this->orders) > 0) {
            foreach ($this->orders as $key => $value) {
                $inventario = $inventario->orderBy($key, $value);
            }
        }

        $inventario = $inventario->paginate(25);

        return view('livewire.pages.inventario.inventario', [
            'inventario' => $inventario
        ]);
    }
}
