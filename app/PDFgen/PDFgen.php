<?php

namespace App\PDFgen;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PDFgen
{
    public function et3barcode($databar, $start, $name)
    {


        $data = $databar;

        if ($start == 1) {

            if (count($data) == 1) {
                $data[] = [];
                $data[] = [];
            } else if (count($data) == 2) {
                $data[] = [];
            }
        } else if ($start == 2) {

            if (count($data) == 1) {
                $data[] = [];
            }

            array_unshift($data, []);
        } else if ($start == 3) {
            array_unshift($data, []);
            array_unshift($data, []);
        }


        $c = 1;
        $group = [];
        foreach ($data as $key => $item) {

            $generator = new BarcodeGeneratorPNG();
            if (isset($item['codigoalm'])) {
                file_put_contents(storage_path("app/img/{$item['codigoalm']}.png"), $generator->getBarcode($item['codigoalm'], $generator::TYPE_CODE_128));
            }

            $group[] = $item;

            if ($c == 3) {
                $datasplitted[] = $group;
                $c = 0;
                $group = [];
            } else if ($key == (count($data) - 1)) {
                $datasplitted[] = $group;
                $c = 0;
                $group = [];
            }


            $c++;
        }


        $pdf = Pdf::setPaper([0, 0, 242.362204, 37.020472], 'portrait')
            ->loadView(
                'livewire.pdf.et3col',
                [
                    'data' => $datasplitted
                ]
            );
        $pdf->render();
        $output = $pdf->output();

        foreach ($data as $key => $item) {
            if (isset($item['codigoalm'])) {
                if (file_exists(storage_path("app/img/{$item['codigoalm']}.png"))) {
                    unlink(storage_path("app/img/{$item['codigoalm']}.png"));
                }
            }
        }

        file_put_contents(storage_path("app/pdf/{$name}.pdf"), $output);
    }
    
    public function et3barcodeinv($databar, $start, $name)
    {


        $data = $databar;

        if ($start == 1) {

            if (count($data) == 1) {
                $data[] = [];
                $data[] = [];
            } else if (count($data) == 2) {
                $data[] = [];
            }
        } else if ($start == 2) {

            if (count($data) == 1) {
                $data[] = [];
            }

            array_unshift($data, []);
        } else if ($start == 3) {
            array_unshift($data, []);
            array_unshift($data, []);
        }


        $c = 1;
        $group = [];
        foreach ($data as $key => $item) {

            $generator = new BarcodeGeneratorPNG();
            if (isset($item['codigo'])) {
                file_put_contents(storage_path("app/img/{$item['codigo']}.png"), $generator->getBarcode($item['codigo'], $generator::TYPE_CODE_128));
            }

            $group[] = $item;

            if ($c == 3) {
                $datasplitted[] = $group;
                $c = 0;
                $group = [];
            } else if ($key == (count($data) - 1)) {
                $datasplitted[] = $group;
                $c = 0;
                $group = [];
            }


            $c++;
        }


        $pdf = Pdf::setPaper([0, 0, 242.362204, 37.020472], 'portrait')
            ->loadView(
                'livewire.pdf.et3colinv',
                [
                    'data' => $datasplitted
                ]
            );
        $pdf->render();
        $output = $pdf->output();

        foreach ($data as $key => $item) {
            if (isset($item['codigo'])) {
                if (file_exists(storage_path("app/img/{$item['codigo']}.png"))) {
                    unlink(storage_path("app/img/{$item['codigo']}.png"));
                }
            }
        }

        file_put_contents(storage_path("app/pdf/{$name}.pdf"), $output);
    }
}
