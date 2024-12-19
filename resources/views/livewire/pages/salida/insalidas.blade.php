<x-modal name="insalidas" maxWidth="4xl">
    <div class="p-4">
        <h2 class="text-md font-bold">Salida - {{ $this->personal?->nombre }} -
            {{ $this->fecemision }}</h2>
        <div class="mt-4">
            <div class="w-full overflow-x-scroll">
                <table class="w-full bg-white border border-gray-300 mt-4 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 border-b text-start">Código</th>
                            <th class="py-2 px-4 border-b text-start">Nombre</th>
                            <th class="py-2 px-4 border-b text-start">Fecha de entrada</th>
                            <th class="py-2 px-4 border-b text-start">Personal</th>
                            <th class="py-2 px-4 border-b text-start">Observaciones</th>
                            <th class="py-2 px-4 border-b text-start"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->detalle as $key => $item)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $item->activo->codigo }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->activo->nombre }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->fecentrada }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->personal?->nombre }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->observacion }}</td>
                                <td class="py-2 px-4 border-b">
                                    @if (!isset($item->fecentrada))
                                        <div class="w-16">
                                            <x-button wire:click="openModalInItem({{ $item['idsaldetalle'] }})"
                                                color="primary">
                                                Ingreso
                                            </x-button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-modal>
