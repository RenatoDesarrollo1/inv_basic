<div>
    <h3 class="text-xl mb-4 font-bold">Personal</h3>
    <div class="mb-6">
        <div class="flex items-center">
            {{-- <x-input-search type="text" wire:model.live="search" placeholder="Buscar..." /> --}}

            <div class="w-32">
                <x-button wire:click.prevent="$dispatch('open-modal', 'addpersonal')" color="secondary">
                    Añadir
                </x-button>
            </div>
        </div>
        <div class="w-full overflow-x-scroll">
            <table class="w-full text-sm bg-white border border-gray-300 mt-4">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-start">ID</th>
                        <th class="py-2 px-4 border-b text-start">Documento</th>
                        <th class="py-2 px-4 border-b text-start">Nombre</th>
                        <th class="py-2 px-4 border-b text-start"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personales as $personal)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $personal->idpersonal }}</td>
                            <td class="py-2 px-4 border-b">{{ $personal->documento }}</td>
                            <td class="py-2 px-4 border-b">{{ $personal->nombre }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="w-32">
                                    <x-button wire:click="openModalEdit({{ $personal->idpersonal }})" color="secondary">
                                        Editar
                                    </x-button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $personales->links(data: ['scrollTo' => false]) }}
    </div>

    <livewire:pages.personal.addpersonal />
    <livewire:pages.personal.editpersonal />
</div>
