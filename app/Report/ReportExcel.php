<?php

namespace App\Report;

use App\Models\InventarioModel;

class ReportExcel
{
    public function report($filtro, $orders, $nombre, $name)
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

        $inventario = $inventario->get()->toArray();

        $columnmap = [
            'codigo' => 'A',
            'codigoubi' => 'B',
            'nombre' => 'C',
            'nombrecategoria' => 'D',
            'nombrelocal' => 'E',
            'nombrepiso' => 'F',
            'nombreambiente' => 'G',
            'nombrepared' => 'H',
            'nombremodulo' => 'I',
            'nombrefa1' => 'J',
            'nombrefa2' => 'K',
            'nombrefa3' => 'L',
            'nombrefa4' => 'M',
            'nombrefa5' => 'N',
            'piezas' => 'O',
            'cantidad' => 'P',
            'marca' => 'R',
            'modelo' => 'S',
            'ram' => 'S',
            'procesador' => 'T',
            'disco' => 'U',
            'serie' => 'V',
            'descripcion' => 'W',
            'dimensiones' => 'X',
            'codigoanterior' => 'Y',
            'precioc' => 'Z',
            'preciov' => 'AA',
            'proveedor' => 'AB',
            'nrofactura' => 'AC',
            'fecfactura' => 'AD',
            'estado' => 'AE',
        ];




        $inputFileName = storage_path('app/excel/reporteexceltemplate.xlsx');

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

        $hoja = $spreadsheet->getSheetByName("REPORTE");

        $row = 2;
        foreach ($inventario as $item) {
            foreach ($item as $key => $value) {
                $column = "";
                if (isset($columnmap[$key])) {
                    $column = $columnmap[$key];
                }
                $cell = $column . $row;
                $val = $value;

                if ($key == "estado") {
                    if ($value) {
                        $val = "Operativo";
                    } else {
                        $val = "Inoperativo";
                    }
                }
                if ($column != "") {
                    $hoja->setCellValue($cell, $val);
                }
            }
            $row++;
        }

        foreach ($hoja->getColumnIterator() as $column) {
            $hoja->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(storage_path("app/excel/{$name}.xlsx"));
    }
}
