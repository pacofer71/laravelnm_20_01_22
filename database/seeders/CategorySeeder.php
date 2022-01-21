<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'nombre'=>"Programación",
            'descripcion'=>'Categoria para programadores'
        ]);
        Category::create([
            'nombre'=>"Bases de Datos",
            'descripcion'=>'Categorias para todo lo que tenga que ver con las BBDD',
        ]);
        Category::create([
            'nombre'=>"Juegos",
            'descripcion'=>'Categoria para jugones'
        ]);
        Category::create([
            'nombre'=>"Deportes",
            'descripcion'=>'Categoria para los deportistas'
        ]);
        Category::create([
            'nombre'=>"Libros",
            'descripcion'=>'Categoria para lo lectores'
        ]);
    }
}
