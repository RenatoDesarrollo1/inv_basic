<div>
    <div class="w-full flex justify-start">
        <div class="px-3 pt-1 cursor-pointer" wire:click="setTab('activos')">
            <h3 class="text-md mb-6 {{ $this->tab == 'activos' ? 'font-bold' : '' }}">Activos</h3>
        </div>
        <div class="px-3 pt-1 cursor-pointer" wire:click="setTab('grupo')">
            <h3 class="text-md mb-6 {{ $this->tab == 'grupo' ? 'font-bold' : '' }}">Grupo <span
                    class="bg-[#3D449A] px-2 text-white rounded-2xl text-sm font-normal">{{ count($this->inventariogroup) }}</span>
            </h3>
        </div>
    </div>
    @switch($this->tab)
        @case('activos')
            <div class="mb-6">
                <div class="flex items-center">
                    {{-- <x-input-search type="text" wire:model.live="search" placeholder="Buscar..." /> --}}

                    <div class="w-36">
                        <x-input label="" type="text" wire:model.live="nombre" :error="$errors->first('nombre')" />
                    </div>
                    <div class="ms-4 w-36">
                        <x-button wire:click.prevent="$dispatch('open-modal', 'filtroinventario')" color="secondary">
                            Filtro
                        </x-button>
                    </div>
                    <div class="ms-4 w-36">
                        <x-button wire:click.prevent="$dispatch('open-modal', 'addinventario')" color="secondary">
                            Añadir
                        </x-button>
                    </div>
                    <div class="ms-4 w-36">
                        <x-button wire:click.prevent="openModalEt()" color="secondary">
                            Generar etiquetas
                        </x-button>
                    </div>
                    <div class="ms-4 w-36">
                        <x-button wire:click.prevent="genExcel()" color="primary">
                            Reporte
                        </x-button>
                    </div>
                </div>
                <div class="w-full overflow-x-scroll mt-4"  style="max-height: 600px;">
                    <table class="table-auto w-full bg-white text-sm">
                        <thead class="bg-gray-100 sticky top-0">
                            <tr>
                                <th wire:click="addOrder('idinventario')" class="py-2 px-4 border-b text-start cursor-pointer">
                                    ID {{ $this->validateOrder('idinventario') }}</th>
                                <th wire:click="addOrder('codigo')" class="py-2 px-4 border-b text-start cursor-pointer">
                                    Código
                                    {{ $this->validateOrder('codigo') }}</th>
                                <th wire:click="addOrder('codigoubi')" class="py-2 px-4 border-b text-start cursor-pointer">
                                    Código Ubicación
                                    {{ $this->validateOrder('codigoubi') }}</th>
                                <th wire:click="addOrder('nombre')" class="py-2 px-4 border-b text-start cursor-pointer">
                                    Nombre
                                    {{ $this->validateOrder('nombre') }}
                                </th>
                                <th wire:click="addOrder('nombrelocal')"
                                    class="py-2 px-4 border-b text-start cursor-pointer">
                                    Local {{ $this->validateOrder('nombrelocal') }}</th>
                                <th wire:click="addOrder('nombrecategoria')"
                                    class="py-2 px-4 border-b text-start cursor-pointer">
                                    Categoría {{ $this->validateOrder('nombrecategoria') }}</th>
                                <th wire:click="addOrder('nombreambiente')"
                                    class="py-2 px-4 border-b text-start cursor-pointer">
                                    Ambiente {{ $this->validateOrder('nombreambiente') }}</th>
                                <th class="py-2 px-4 border-b text-start">Fecha Sal.</th>
                                <th class="py-2 px-4 border-b text-start"></th>
                            </tr>
                        </thead>
                        <tbody class="border-y border-gray-300">
                            @foreach ($inventario as $item)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $item->idinventario }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->codigo }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->codigoubi }}</td>
                                    <td class="py-2 px-4 border-b w-32 overflow-x-scroll  text-nowrap whitespace-nowrap flex">
                                        {{ $item->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->local?->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->categoria?->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->ambiente?->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item?->salcabecera?->fecemision }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <div class="flex gap-x-2">
                                            <div class="w-8">
                                                <x-button title="Añadir al grupo"
                                                    wire:click="addGroup({{ $item->idinventario }})" color="primary"
                                                    isDisabled="{{ $this->validateGroup($item->idinventario) }}">
                                                    +
                                                </x-button>
                                            </div>
                                            <div class="w-16">
                                                <x-button wire:click="openModalEdit({{ $item->idinventario }})"
                                                    color="primary">
                                                    Editar
                                                </x-button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $inventario->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        @break

        @case('grupo')
            <div class="mb-6">
                @if (count($this->inventariogroup) > 0)
                    <div class="flex items-center">
                        <div class="w-36">
                            <x-button wire:click.prevent="openModalEtgroup()" color="secondary">
                                Generar etiquetas
                            </x-button>
                        </div>
                        <div class="ms-4 w-36">
                            <x-button wire:click.prevent="openModalSalgroup()" color="secondary">
                                Generar salida
                            </x-button>
                        </div>
                    </div>
                    <div class="w-full overflow-x-scroll">
                        <table class="w-full bg-white border border-gray-300 mt-4 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b text-start">ID</th>
                                    <th class="py-2 px-4 border-b text-start">Código</th>
                                    <th class="py-2 px-4 border-b text-start">Código Ubicación</th>
                                    <th class="py-2 px-4 border-b text-start">Nombre</th>
                                    <th class="py-2 px-4 border-b text-start">Local</th>
                                    <th class="py-2 px-4 border-b text-start">Categoría</th>
                                    <th class="py-2 px-4 border-b text-start">Ambiente</th>
                                    <th class="py-2 px-4 border-b text-start"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventariogroup as $key => $item)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $item['idinventario'] }}</td>
                                        <td class="py-2 px-4 border-b">{{ $item['codigo'] }}</td>
                                        <td class="py-2 px-4 border-b">{{ $item['codigoubi'] }}</td>
                                        <td class="py-2 px-4 border-b">{{ $item['nombre'] }}</td>
                                        <td class="py-2 px-4 border-b">{{ $item['local']['nombre'] ?? '' }}</td>
                                        <td class="py-2 px-4 border-b">{{ $item['categoria']['nombre'] ?? '' }}</td>
                                        <td class="py-2 px-4 border-b">{{ $item['ambiente']['nombre'] ?? '' }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <div class="w-8">
                                                <x-button wire:click="deleteGroup({{ $key }})" color="danger">
                                                    X
                                                </x-button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @break

        @default
    @endswitch



    <livewire:pages.inventario.addinventario />
    <livewire:pages.inventario.editinventario />
    <livewire:pages.inventario.deleteinventario />
    <livewire:pages.inventario.etinventario />
    <livewire:pages.inventario.etgroupinventario />
    <livewire:pages.inventario.salidainventario />
    <livewire:pages.inventario.filtroinventario />
</div>

