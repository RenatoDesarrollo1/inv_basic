<x-modal name="deletesalidas" maxWidth="lg">
    <div class="p-4">
        <h2 class="text-md font-bold">Eliminar salida</h2>
        <div class="mt-3">
            <p class="text-sm">Desea eliminar esta salida?</p>
            <div class="mt-4">
                <x-button wire:click="delete()" color="danger">
                    Eliminar
                </x-button>
            </div>
        </div>
    </div>
</x-modal>
