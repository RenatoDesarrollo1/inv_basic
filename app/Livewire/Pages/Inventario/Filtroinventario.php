<?php

namespace App\Livewire\Pages\Inventario;

use Livewire\Attributes\On;
use Livewire\Component;

class Filtroinventario extends Component
{
    public $filtro = [];



    public function render()
    {
        return view('livewire.pages.inventario.filtroinventario');
    }
}
