<?php

namespace App\Livewire\Pages\Personal;

use App\Models\EntidadModel;
use App\Models\PersonalModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Personal')]
class Personal extends Component
{
    use WithPagination;

    public function openModalEdit($id)
    {
        $this->dispatch('open-modal', 'editpersonal');
        $this->dispatch('getpersonal', id: $id);
    }

    #[On('personal-submitted')]
    public function render()
    {
        return view('livewire.pages.personal.personal', [
            'personales' => PersonalModel::paginate(10)
        ]);
    }
}
