<x-modal name="addinventario" maxWidth="xl">
    <div class="p-4">
        <h2 class="text-md font-bold">Añadir activo</h2>
        <div class="mt-4">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-3 gap-4">
                    <x-select label="Local" type="text" wire:model.live="idlocal" :error="$errors->first('idlocal')">
                        @foreach (\App\Models\LocalModel::all() as $local)
                            <option value="{{ $local->idlocal }}">{{ $local->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Piso" type="text" wire:model.live="idpiso" :error="$errors->first('idpiso')">
                        @foreach (\App\Models\PisoModel::all() as $piso)
                            <option value="{{ $piso->idpiso }}">{{ $piso->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Ambiente" type="text" wire:model.live="idambiente" :error="$errors->first('idambiente')">
                        @foreach (\App\Models\AmbienteModel::all() as $ambiente)
                            <option value="{{ $ambiente->idambiente }}">{{ $ambiente->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Paredes" type="text" wire:model.live="idpared" :error="$errors->first('idpared')">
                        @foreach (\App\Models\ParedesModel::all() as $paredes)
                            <option value="{{ $paredes->idpared }}">{{ $paredes->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Módulo" type="text" wire:model.live="idmodulo" :error="$errors->first('idmodulo')">
                        @foreach (\App\Models\ModuloModel::all() as $modulo)
                            <option value="{{ $modulo->idmodulo }}">{{ $modulo->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Fondo/Alto 1" type="text" wire:model.live="idfondoalto1" :error="$errors->first('idfondoalto1')">
                        @foreach (\App\Models\FondoaltoModel1::all() as $fondoalto)
                            <option value="{{ $fondoalto->idfondoalto }}">{{ $fondoalto->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Fondo/Alto 2" type="text" wire:model.live="idfondoalto2" :error="$errors->first('idfondoalto2')">
                        @foreach (\App\Models\FondoaltoModel::all() as $fondoalto)
                            <option value="{{ $fondoalto->idfondoalto }}">{{ $fondoalto->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Fondo/Alto 3" type="text" wire:model.live="idfondoalto3" :error="$errors->first('idfondoalto3')">
                        <option value="1">DESCONOCIDO</option>
                    </x-select>
                    <x-select label="Fondo/Alto 4" type="text" wire:model.live="idfondoalto4" :error="$errors->first('idfondoalto4')">
                        <option value="1">DESCONOCIDO</option>
                    </x-select>
                    <x-select label="Fondo/Alto 5" type="text" wire:model.live="idfondoalto5" :error="$errors->first('idfondoalto5')">
                        <option value="1">DESCONOCIDO</option>
                    </x-select>
                    <x-input label="Piezas" type="number" wire:model="piezas" :error="$errors->first('piezas')" />
                    <x-select label="Categoría" type="text" wire:model.live="idcategoria" :error="$errors->first('idcategoria')">
                        <option value="">Seleccionar categoria</option>
                        @foreach (\App\Models\CategoriaModel::all() as $categoria)
                            <option value="{{ $categoria->idcategoria }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-input required label="Nombre" type="text" wire:model="nombre" :error="$errors->first('nombre')" />
                    <x-input label="Cantidad" type="number" wire:model="cantidad" :error="$errors->first('cantidad')" />
                    <x-input label="Marca" type="text" wire:model="marca" :error="$errors->first('marca')" />
                    <x-input label="Modelo" type="text" wire:model="modelo" :error="$errors->first('modelo')" />
                    <x-input label="RAM" type="text" wire:model="ram" :error="$errors->first('ram')" />
                    <x-input label="Procesador" type="text" wire:model="procesador" :error="$errors->first('procesador')" />
                    <x-input label="Disco" type="text" wire:model="disco" :error="$errors->first('disco')" />
                    <x-input label="Serie" type="text" wire:model="serie" :error="$errors->first('serie')" />
                    <x-input label="Descripción" type="text" wire:model="descripcion" :error="$errors->first('descripcion')" />
                    <x-input label="Dimensiones" type="text" wire:model="dimensiones" :error="$errors->first('dimensiones')" />
                    <x-input label="Código Anterior" type="text" wire:model="codigoanterior" :error="$errors->first('codigoanterior')" />
                    <x-input label="Precio de compra" type="number" wire:model="precioc" :error="$errors->first('precioc')" />
                    <x-input label="Precio de venta" type="number" wire:model="preciov" :error="$errors->first('preciov')" />
                    <x-input label="Proveedor" type="text" wire:model="proveedor" :error="$errors->first('proveedor')" />
                    <x-input label="Nro Factura" type="text" wire:model="nrofactura" :error="$errors->first('nrofactura')" />
                    <x-input label="Fecha Factura" type="date" wire:model="fecfactura" :error="$errors->first('fecfactura')" />
                    <x-select label="Estado" type="text" wire:model="estado" :error="$errors->first('estado')">
                        <option value="1">Operativo</option>
                        <option value="0">Inoperativo</option>
                    </x-select>
                </div>
                <div class="mt-6">
                    <x-button type="submit" color="primary">
                        Guardar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-modal>
