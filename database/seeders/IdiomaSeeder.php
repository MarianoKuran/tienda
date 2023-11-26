<?php

namespace Database\Seeders;

use App\Models\Idioma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdiomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idioma = Idioma::where('Codigo', 'es')->first();
        if ($idioma == null) {
            $idiomaNuevo = new Idioma;
            $idiomaNuevo->Descripcion = 'Español';
            $idiomaNuevo->Codigo = 'es';
            $idiomaNuevo->Seleccionado = 1;
            $idiomaNuevo->save();
        }

        $idioma = Idioma::where('Codigo', 'en')->first();
        if ($idioma == null) {
            $idiomaNuevo = new Idioma;
            $idiomaNuevo->Descripcion = 'Ingles';
            $idiomaNuevo->Codigo = 'en';
            $idiomaNuevo->Seleccionado = 0;
            $idiomaNuevo->save();
        }

        $idioma = Idioma::where('Codigo', 'de')->first();
        if ($idioma == null) {
            $idiomaNuevo = new Idioma;
            $idiomaNuevo->Descripcion = 'Aleman';
            $idiomaNuevo->Codigo = 'de';
            $idiomaNuevo->Seleccionado = 0;
            $idiomaNuevo->save();
        }

        $idioma = Idioma::where('Codigo', 'it')->first();
        if ($idioma == null) {
            $idiomaNuevo = new Idioma;
            $idiomaNuevo->Descripcion = 'Italiano';
            $idiomaNuevo->Codigo = 'it';
            $idiomaNuevo->Seleccionado = 0;
            $idiomaNuevo->save();
        }

        $idioma = Idioma::where('Codigo', 'pt')->first();
        if ($idioma == null) {
            $idiomaNuevo = new Idioma;
            $idiomaNuevo->Descripcion = 'Portugues';
            $idiomaNuevo->Codigo = 'pt';
            $idiomaNuevo->Seleccionado = 0;
            $idiomaNuevo->save();
        }
    }
}
