<?php

namespace App\Livewire\Pages\Salida;

use App\Models\SalidaCabModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Salidas')]
class Salidas extends Component
{
    use WithPagination;

    public function openModalEdit($id)
    {
        $this->dispatch('open-modal', 'editsalidas');
        $this->dispatch('getsalida', id: $id);
    }

    public function openModalDelete($id)
    {
        $this->dispatch('open-modal', 'deletesalidas');
        $this->dispatch('getsalidadelete', id: $id);
    }

    public function openModalIn($id)
    {
        $this->dispatch('open-modal', 'insalidas');
        $this->dispatch('getsalidain', id: $id);
    }

    #[On('salida-submitted')]
    public function render()
    {
        $salidas = SalidaCabModel::paginate(20);

        return view('livewire.pages.salida.salidas', [
            'salidas' => $salidas
        ]);
    }
}
