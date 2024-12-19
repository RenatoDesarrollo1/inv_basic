<?php

use App\Livewire\Pages\Activos\Activos;
use App\Livewire\Pages\Inventario\Inventario;
use App\Livewire\Pages\Personal\Personal;
use App\Livewire\Pages\Salida\Salidas;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::get('/inventario', Inventario::class);
    Route::get('/personal', Personal::class);
    // Route::get('/activos', Activos::class);
    Route::get('/salidas', Salidas::class);
});

require __DIR__.'/auth.php';
