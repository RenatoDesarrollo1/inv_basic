<?php

namespace App\Livewire\Pages\Personal;

use App\Models\PersonalModel;
use Livewire\Component;

class Addpersonal extends Component
{
    public string $documento;
    public string $nombre;

    public function mount()
    {
        $this->documento = "";
        $this->nombre = "";
    }

    public function save()
    {
        $validated = $this->validate([
            "documento" => ["required", "string", "max:11"],
            "nombre" => ["required", "string", "max:100"],
        ], [
            'documento.required' => "Este campo es requerido",
            'nombre.required' => "Este campo es requerido",
            'documento.max' => "Solo se admiten 12 carácteres",
            'nombre.max' => "Solo se admiten 100 carácteres",
        ]);


        PersonalModel::create($validated);

        $this->reset();
        $this->dispatch('close-modal', 'addpersonal');
        $this->dispatch('personal-submitted');
    }

    public function render()
    {
        return view('livewire.pages.personal.addpersonal');
    }
}
