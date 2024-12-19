<x-modal name="editpersonal" maxWidth="md">
    <div class="relative p-4">
        <h2 class="text-md font-bold">Editar Personal</h2>
        <div class="mt-4">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 gap-y-4">
                    <x-input id="documento" label="Documento" type="text" wire:model="documento" :error="$errors->first('documento')" />
                    <x-input id="nombre" label="Nombre" type="text" wire:model="nombre" :error="$errors->first('nombre')" />
                    <x-button type="submit" color="primary">
                        Guardar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-modal>
