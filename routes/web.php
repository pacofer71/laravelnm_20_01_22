<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    $posts=Post::orderBy('id', 'desc')->get();
    return view('welcome', compact('posts'));
});
*/
Route::get('/', 'App\Http\Controllers\InicioController@index')->name('inicio');
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);

Route::get('posts1/{tag}', "App\Http\Controllers\PostController@index1")->name('posts.index1');
//Contactos
Route::get('contacto', 'App\Http\Controllers\ContactoController@index')->name('contacto.index');
Route::post('contacto', 'App\Http\Controllers\ContactoController@enviar')->name('contacto.enviar');