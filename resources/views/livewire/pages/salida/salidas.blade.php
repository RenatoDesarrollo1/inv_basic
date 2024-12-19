<div>
    <div class="w-full flex justify-start">
        <h3 class="text-xl mb-6 font-bold">Salidas</h3>
    </div>
    <div class="mb-6">
        <div class="flex items-center"> </div>
        <div class="w-full overflow-x-scroll">
            <table class="w-full bg-white border border-gray-300 mt-4 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-start">ID</th>
                        <th class="py-2 px-4 border-b text-start">Fecha Sal.</th>
                        <th class="py-2 px-4 border-b text-start">Personal</th>
                        <th class="py-2 px-4 border-b text-start">Estado</th>
                        <th class="py-2 px-4 border-b text-start">Observaciones</th>
                        <th class="py-2 px-4 border-b text-start"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salidas as $salida)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $salida->idsalcabecera }}</td>
                            <td class="py-2 px-4 border-b">{{ $salida->fecemision }}</td>
                            <td class="py-2 px-4 border-b">{{ $salida->personal?->nombre }}</td>
                            <td class="py-2 px-4 border-b">{{ $salida->estado ? 'Confirmado' : 'En espera' }}</td>
                            <td class="py-2 px-4 border-b">{{ $salida->observacion }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex gap-x-2">
                                    @if (!$salida->estado)
                                        <div class="w-16">
                                            <x-button wire:click="openModalEdit({{ $salida->idsalcabecera }})"
                                                color="primary">
                                                Editar
                                            </x-button>
                                        </div>
                                        <div class="w-16">
                                            <x-button wire:click="openModalDelete({{ $salida->idsalcabecera }})"
                                                color="danger">
                                                Eliminar
                                            </x-button>
                                        </div>
                                    @else
                                        <div class="w-16">
                                            <x-button wire:click="openModalIn({{ $salida->idsalcabecera }})"
                                                color="primary">
                                                Ingresos
                                            </x-button>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $salidas->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <livewire:pages.salida.editsalidas />
    <livewire:pages.salida.deletesalidas />
    <livewire:pages.salida.insalidas />
    <livewire:pages.salida.initemsalidas />
</div>
