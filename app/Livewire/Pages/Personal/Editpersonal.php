<?php

namespace App\Livewire\Pages\Personal;

use App\Models\PersonalModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Editpersonal extends Component
{
    public int $idpersonal;
    public string $documento;
    public string $nombre;

    public function mount()
    {
        $this->idpersonal = 0;
        $this->documento = "";
        $this->nombre = "";
    }

    #[On('getpersonal')]
    public function getPersonal($id)
    {
        $personal = PersonalModel::where('idpersonal', $id)->first();
        if (isset($personal->idpersonal)) {
            $this->idpersonal = $personal->idpersonal;
            $this->documento = $personal->documento;
            $this->nombre = $personal->nombre;
        }
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


        PersonalModel::where('idpersonal', $this->idpersonal)->update($validated);

        $this->reset();
        $this->dispatch('close-modal', 'editpersonal');
        $this->dispatch('personal-submitted');
    }

    public function render()
    {
        return view('livewire.pages.personal.editpersonal');
    }
}
