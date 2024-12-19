<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            [
                "username" => "admin",
                "email" => "admin@admin.com",
                "password" => Hash::make('admin')
            ]
        ]);

        DB::table('invent_categoria')->insert([
            [
                "nombre" => "Equipos Informaticos",
                "corr" => "001",
            ],
            [
                "nombre" => "Mobiliario",
                "corr" => "002",
            ],
            [
                "nombre" => "Equipos de Oficina",
                "corr" => "003",
            ],
            [
                "nombre" => "Equipos de Seguridad",
                "corr" => "004",
            ],
            [
                "nombre" => "Decoración",
                "corr" => "005",
            ],
            [
                "nombre" => "Equipamiento",
                "corr" => "006",
            ],
            [
                "nombre" => "Instrumentos de Medicion",
                "corr" => "007",
            ],
            [
                "nombre" => "Equipos de Medicion",
                "corr" => "008",
            ],
            [
                "nombre" => "Herramienta",
                "corr" => "009",
            ],
            [
                "nombre" => "Consumibles",
                "corr" => "010",
            ],
            [
                "nombre" => "Piezas de Repuesto",
                "corr" => "011",
            ],
            [
                "nombre" => "Productos Químicos",
                "corr" => "012",
            ],
        ]);

        DB::table('invent_local')->insert([
            [
                "nombre" => "DESCONOCIDO",
                "cod" => "0",
            ],
            [
                "nombre" => "A DEL CARPIO",
                "cod" => "1",
            ],
            [
                "nombre" => "BREÑA",
                "cod" => "2",
            ],
            [
                "nombre" => "LOS OLIVOS",
                "cod" => "3",
            ],
            [
                "nombre" => "NUEVO LOCAL",
                "cod" => "4",
            ],
        ]);

        DB::table('invent_piso')->insert([
            [
                "nombre" => "1er PISO",
                "cod" => "1",
            ],
            [
                "nombre" => "2do PISO",
                "cod" => "2",
            ],
            [
                "nombre" => "3er PISO",
                "cod" => "3",
            ],
            [
                "nombre" => "4to PISO",
                "cod" => "4",
            ],
            [
                "nombre" => "AZOTEA",
                "cod" => "A",
            ],
            [
                "nombre" => "1 ENTREPISO S/1",
                "cod" => "E",
            ],
            [
                "nombre" => "2 ENTREPISO 1/2",
                "cod" => "F",
            ],
            [
                "nombre" => "3 ENTREPISO 2/3",
                "cod" => "G",
            ],
            [
                "nombre" => "4 ENTREPISO 3/4",
                "cod" => "H",
            ],
            [
                "nombre" => "5 ENTREPISO 4/5",
                "cod" => "I",
            ],
            [
                "nombre" => "LOBBY",
                "cod" => "L",
            ],
            [
                "nombre" => "SOTANO",
                "cod" => "S",
            ],
            [
                "nombre" => "SOTANO 2",
                "cod" => "T",
            ],
            [
                "nombre" => "SOTANO 3",
                "cod" => "U",
            ],
        ]);

        DB::table('invent_ambiente')->insert([
            [
                "nombre" => "DESCONOCIDO",
                "cod" => "00",
            ],
            [
                "nombre" => "GERENCIA",
                "cod" => "01",
            ],
            [
                "nombre" => "OFICINA",
                "cod" => "02",
            ],
            [
                "nombre" => "LABORATORIO",
                "cod" => "03",
            ],
            [
                "nombre" => "ALMACEN",
                "cod" => "04",
            ],
            [
                "nombre" => "CUARTO",
                "cod" => "05",
            ],
            [
                "nombre" => "BAÑO",
                "cod" => "06",
            ],
        ]);


        DB::table('invent_paredes')->insert([
            [
                "nombre" => "DESCONOCIDO",
                "cod" => "0",
            ],
            [
                "nombre" => "PISO",
                "cod" => "1",
            ],
            [
                "nombre" => "IZ PARED IZQUIER",
                "cod" => "2",
            ],
            [
                "nombre" => "FR PARED FRENTE",
                "cod" => "3",
            ],
            [
                "nombre" => "DE PARED DERECH",
                "cod" => "4",
            ],
            [
                "nombre" => "IN PARED INGRESO",
                "cod" => "5",
            ],
            [
                "nombre" => "TECHO",
                "cod" => "6",
            ],
            [
                "nombre" => "ALERO",
                "cod" => "7",
            ],
        ]);

        DB::table('invent_modulo')->insert([
            [
                "nombre" => "DESCONOCIDO",
                "cod" => "0",
            ],
            [
                "nombre" => "1 MODULO",
                "cod" => "1",
            ],
            [
                "nombre" => "2 MODULO",
                "cod" => "2",
            ],
            [
                "nombre" => "3 MODULO",
                "cod" => "3",
            ],
            [
                "nombre" => "4 MODULO",
                "cod" => "4",
            ],
            [
                "nombre" => "5 MODULO",
                "cod" => "5",
            ],
            [
                "nombre" => "6 MODULO",
                "cod" => "6",
            ],
            [
                "nombre" => "7 MODULO",
                "cod" => "7",
            ],
            [
                "nombre" => "8 MODULO",
                "cod" => "8",
            ],
            [
                "nombre" => "9 MODULO",
                "cod" => "9",
            ],
        ]);


        DB::table('invent_fondoalto')->insert([
            [
                "nombre" => "DESCONOCIDO",
                "cod" => "0",
            ],
            [
                "nombre" => "FONDO/ALTO IZQ",
                "cod" => "1",
            ],
            [
                "nombre" => "FONDO/ALTO CTRO",
                "cod" => "2",
            ],
            [
                "nombre" => "FONDO/ALTO DER",
                "cod" => "3",
            ],
            [
                "nombre" => "CTRO/MEDIO IZQ",
                "cod" => "4",
            ],
            [
                "nombre" => "CTRO/MEDIO CTRO",
                "cod" => "5",
            ],
            [
                "nombre" => "CTRO/MEDIO DER",
                "cod" => "6",
            ],
            [
                "nombre" => "CERCA/ABAJO IZQ",
                "cod" => "7",
            ],
            [
                "nombre" => "CERCA/ABAJO CTRO",
                "cod" => "8",
            ],
            [
                "nombre" => "CERCA/ABAJO DER",
                "cod" => "9",
            ],
        ]);

        DB::table('invent_fondoalto1')->insert([
            [
                "nombre" => "DESCONOCIDO",
                "cod" => "0",
            ],
            [
                "nombre" => "ALTO IZQ",
                "cod" => "1",
            ],
            [
                "nombre" => "ALTO CTRO",
                "cod" => "2",
            ],
            [
                "nombre" => "ALTO DER",
                "cod" => "3",
            ],
            [
                "nombre" => "MEDIO IZQ",
                "cod" => "4",
            ],
            [
                "nombre" => "MEDIO CTRO",
                "cod" => "5",
            ],
            [
                "nombre" => "MEDIO DER",
                "cod" => "6",
            ],
            [
                "nombre" => "BAJO IZQ",
                "cod" => "7",
            ],
            [
                "nombre" => "BAJO CTRO",
                "cod" => "8",
            ],
            [
                "nombre" => "BAJO DER",
                "cod" => "9",
            ],
        ]);
    }
}
