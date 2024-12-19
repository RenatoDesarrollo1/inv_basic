<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invent_inventario', function (Blueprint $table) {
            $table->increments('idinventario');
            $table->string('codigo', 20)->nullable();
            $table->string('codigoubi', 20)->nullable();
            $table->unsignedInteger('idcategoria')->nullable();
            $table->unsignedInteger('idlocal')->nullable();
            $table->unsignedInteger('idpiso')->nullable();
            $table->unsignedInteger('idambiente')->nullable();
            $table->unsignedInteger('idpared')->nullable();
            $table->unsignedInteger('idmodulo')->nullable();
            $table->unsignedInteger('idfondoalto1')->nullable();
            $table->unsignedInteger('idfondoalto2')->nullable();
            $table->unsignedInteger('idfondoalto3')->nullable();
            $table->unsignedInteger('idfondoalto4')->nullable();
            $table->unsignedInteger('idfondoalto5')->nullable();
            $table->unsignedInteger('piezas')->default(0);
            $table->unsignedInteger('cantidad')->default(1);
            $table->string('nombre', 250)->nullable();
            $table->string('marca', 50)->nullable();
            $table->string('modelo', 50)->nullable();
            $table->string('ram', 50)->nullable();
            $table->string('procesador', 50)->nullable();
            $table->string('disco', 50)->nullable();
            $table->string('serie', 50)->nullable();
            $table->string('descripcion', 100)->nullable();
            $table->string('dimensiones', 50)->nullable();
            $table->string('codigoanterior', 20)->nullable();
            $table->decimal("precioc", 12, 2)->nullable();
            $table->decimal("preciov", 12, 2)->nullable();
            $table->string('nrofactura', 30)->nullable();
            $table->string('proveedor', 100)->nullable();
            $table->date('fecfactura')->nullable();
            $table->boolean('estado')->default(true);
            $table->unsignedInteger('idsalcabecera')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activos');
    }
};
