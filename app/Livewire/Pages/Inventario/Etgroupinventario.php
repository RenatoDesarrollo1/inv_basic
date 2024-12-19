<?php

namespace App\Livewire\Pages\Inventario;

use App\PDFgen\PDFgen;
use Livewire\Attributes\On;
use Livewire\Component;

class Etgroupinventario extends Component
{
    public $data = [];
    public int $start;

    public function mount()
    {
        $this->start = 1;
    }

    #[On('getdata')]
    public function getData($data)
    {
        $this->data = $data;
        $this->dispatch('open-modal', 'etgroupinventario');
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
        return view('livewire.pages.inventario.etgroupinventario');
    }
}
