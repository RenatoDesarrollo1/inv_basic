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
        Schema::create('invent_fondoalto', function (Blueprint $table) {
            $table->increments('idfondoalto');
            $table->string('nombre', 100);
            $table->string('cod', 1);
            $table->timestamps();
        });
        Schema::create('invent_fondoalto1', function (Blueprint $table) {
            $table->increments('idfondoalto');
            $table->string('nombre', 100);
            $table->string('cod', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invent_fondoalto');
        Schema::dropIfExists('invent_fondoalto1');
    }
};
