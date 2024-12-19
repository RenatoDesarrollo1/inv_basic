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
        Schema::create('invent_salcabecera', function (Blueprint $table) {
            $table->increments('idsalcabecera');
            $table->dateTime('fecemision')->nullable();
            $table->unsignedInteger('idpersonal')->nullable();
            $table->string('observacion', 100)->nullable();
            $table->boolean('estado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salcabecera');
    }
};
