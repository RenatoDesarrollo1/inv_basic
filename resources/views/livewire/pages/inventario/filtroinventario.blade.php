<x-modal name="filtroinventario" maxWidth="md">
    <div class="p-4">
        <h2 class="text-md font-bold">Filtro</h2>
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-y-4" wire:ignore>
                <x-select id="idcategoria" multiple label="Categoria" type="text" wire:model.live="idcategoria">
                    @foreach (\App\Models\CategoriaModel::all() as $categoria)
                    <option value="{{ $categoria->idcategoria }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </x-select>
                <x-select id="idlocal" label="Local" multiple type="text" wire:model.live="idlocal"
                    :error="$errors->first('idlocal')">
                    @foreach (\App\Models\LocalModel::all() as $local)
                    <option value="{{ $local->idlocal }}">{{ $local->nombre }}</option>
                    @endforeach
                </x-select>
                <x-select id="idpiso" label="Piso" multiple type="text" wire:model.live="idpiso"
                    :error="$errors->first('idpiso')">
                    @foreach (\App\Models\PisoModel::all() as $piso)
                    <option value="{{ $piso->idpiso }}">{{ $piso->nombre }}</option>
                    @endforeach
                </x-select>
                <x-select id="idambiente" label="Ambiente" multiple type="text" wire:model.live="idambiente"
                    :error="$errors->first('idambiente')">
                    @foreach (\App\Models\AmbienteModel::all() as $ambiente)
                    <option value="{{ $ambiente->idambiente }}">{{ $ambiente->nombre }}</option>
                    @endforeach
                </x-select>
                <x-select id="idpared" label="Paredes" multiple type="text" wire:model.live="idpared"
                    :error="$errors->first('idpared')">
                    @foreach (\App\Models\ParedesModel::all() as $paredes)
                    <option value="{{ $paredes->idpared }}">{{ $paredes->nombre }}</option>
                    @endforeach
                </x-select>
                <x-select id="idmodulo" label="Modulo" multiple type="text" wire:model.live="idmodulo"
                    :error="$errors->first('idmodulo')">
                    @foreach (\App\Models\ModuloModel::all() as $modulo)
                    <option value="{{ $modulo->idmodulo }}">{{ $modulo->nombre }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mt-6">
                <x-button id="clear" color="primary">
                    Limpiar filtro
                </x-button>
            </div>
        </div>
    </div>
    @script()
    <script>
        $(document).ready(function() {

           

            $('#idcategoria').select2();
            $('#idcategoria').on('change', function() {
                let data = $(this).val();
                Livewire.dispatch('inventario-filtro', {
                    field: "invent_inventario.idcategoria",
                    value: data
                })

            });


            $('#idlocal').select2();
            $('#idlocal').on('change', function() {
                let data = $(this).val();
                Livewire.dispatch('inventario-filtro', {
                    field: "invent_inventario.idlocal",
                    value: data
                })

            });

            $('#idpiso').select2();
            $('#idpiso').on('change', function() {
                let data = $(this).val();
                Livewire.dispatch('inventario-filtro', {
                    field: "invent_inventario.idpiso",
                    value: data
                })

            });

            $('#idambiente').select2();
            $('#idambiente').on('change', function() {
                let data = $(this).val();
                Livewire.dispatch('inventario-filtro', {
                    field: "invent_inventario.idambiente",
                    value: data
                })

            });

            $('#idpared').select2();
            $('#idpared').on('change', function() {
                let data = $(this).val();
                Livewire.dispatch('inventario-filtro', {
                    field: "invent_inventario.idpared",
                    value: data
                })

            });

            $('#idmodulo').select2();
            $('#idmodulo').on('change', function() {
                let data = $(this).val();
                Livewire.dispatch('inventario-filtro', {
                    field: "invent_inventario.idmodulo",
                    value: data
                })

            });

            $('#clear').on('click', function() {
                $("#idcategoria").val([]).change();
                $("#idlocal").val([]).change();
                $("#idpiso").val([]).change();
                $("#idambiente").val([]).change();
                $("#idpared").val([]).change();
                $("#idmodulo").val([]).change();
            })
        });
    </script>
    @endscript
</x-modal>