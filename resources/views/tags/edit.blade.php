@extends('layouts.uno')
@section('titulo')
    Editar Etiqueta
@endsection
@section('cabecera')
Editar Etiqueta ({{$tag->id}})
@endsection
@section('contenido')
<div class="mx-auto bg-teal-500 w-3/4 p-4 shadow-md rounded">
    <form name="d" action="{{route('tags.update', $tag)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="nombre">
              Nombre
            </label>
            <input value="{{$tag->nombre}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" placeholder="Nombre" name="nombre">
            @error('nombre')
            <p class="my-2 text-red-900 font-bold text-sm">*** {{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="desc">
              Descripción
            </label>
            <input value="{{$tag->descripcion}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="desc" type="text" placeholder="Descripción" name="descripcion">
            @error('descripcion')
            <p class="my-2 text-red-900 font-bold text-sm">*** {{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="desc">
              Color
            </label>
            <input value="{{$tag->color}}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="desc" type="color" placeholder="Descripción" name="color" required>
            @error('color')
            <p class="my-2 text-red-900 font-bold text-sm">*** {{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"><i class="fas fa-edit"></i> Editar</button>
        </div>    

    </form>
</div>
@endsection