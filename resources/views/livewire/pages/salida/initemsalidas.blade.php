<x-modal name="initemsalidas" maxWidth="md">
    <div class="p-4">
        <h2 class="text-md font-bold">Ingreso {{ $this->activo?->nombre }}</h2>
        <div class="mt-4">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 gap-y-4">
                    <x-input label="Fecha de entrada" type="datetime-local" wire:model="fecentrada" :error="$errors->first('fecentrada')" />
                    <x-select label="Responsable" wire:model="idpersonal" :error="$errors->first('idpersonal')">
                        @foreach (\App\Models\PersonalModel::where('estado', 1)->get() as $personal)
                            <option value="{{ $personal->idpersonal }}">{{ $personal->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-input label="Observaciones" type="text" wire:model="observacion" :error="$errors->first('observacion')" />
                    <x-button type="submit" color="primary">
                        Generar ingreso
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-modal>
