<x-modal name="etinventario" maxWidth="md">
     <div class="p-4">
        <h2 class="text-md font-bold">Etiquetas</h2>
        <div class="mt-4">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 gap-y-4">
                    <x-input label="Inicio de columna" type="number" wire:model="start" min="1" max="3"
                        :error="$errors->first('start')" />
                    <x-button type="submit" color="primary">
                        Código de barras
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-modal>

