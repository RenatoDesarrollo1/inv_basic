<x-modal name="salidainventario" maxWidth="md">
    <div class="p-4">
        <h2 class="text-md font-bold">Salida</h2>
        <div class="mt-4">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 gap-y-4">
                    <div class="max-h-20 text-sm overflow-y-scroll">
                        @foreach ($this->inventariogroup as $item)
                            <div class="py-1 {{ isset($item['idsalcabecera']) ? 'text-red-500' : '' }}">
                                {{ $item['codigo'] }} - {{ $item['nombre'] }}</div>
                        @endforeach
                    </div>
                    <x-input label="Fecha de emisión" type="datetime-local" wire:model="fecemision" :error="$errors->first('fecemision')" />
                    <x-select label="Responsable" wire:model="idpersonal" :error="$errors->first('idpersonal')">
                        @foreach (\App\Models\PersonalModel::all() as $personal)
                            <option value="{{ $personal->idpersonal }}">{{ $personal->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-input label="Observaciones" type="text" wire:model="observacion" :error="$errors->first('observacion')" />
                    <x-button type="submit" color="primary">
                        Generar salida
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-modal>
