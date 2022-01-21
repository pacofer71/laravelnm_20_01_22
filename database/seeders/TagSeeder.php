<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'nombre'=>"General",
            'descripcion'=>'Etiqueta para inclasificables',
            'color'=>"#bbdefb"
        ]);
        Tag::create([
            'nombre'=>"Frontend",
            'descripcion'=>'Etiqueta desarrollo web frontend',
            'color'=>"#aed581"
        ]);
        Tag::create([
            'nombre'=>"Backend",
            'descripcion'=>'Etiqueta desarrollo web en backend',
            'color'=>"#ffb74d"
        ]);
        Tag::create([
            'nombre'=>"Estilos",
            'descripcion'=>'Etiqueta estilos web, tailwind, bootstrap, css',
            'color'=>"#b39ddb"
        ]);
    }
}
