@extends('layouts.uno')
@section('titulo')
    Editar Registro
@endsection
@section('cabecera')
Editar Registro
@endsection
@section('contenido')
<div class="bg-gray-300 rounded py-4 px-2 w-3/4 mx-auto">
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="tit" class="block text-sm font-medium text-gray-700 mb-2">Título Post</label>
            <input type="text" name="titulo" id="tit" value="{{$post->titulo}}"
                class="py-2 px-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md"
                placeholder="Título" required>
            @error('titulo')
                <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        <div class="mt-2">
            <label for="res" class="block text-sm font-medium text-gray-700 mb-2">Resumen Post</label>
            <input type="text" name="resumen" id="res" value="{{$post->resumen}}"
                class="px-2 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md"
                placeholder="Resumen" required>
            @error('resumen')
                <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        <div class="mt-2">
            <label for="cont" class="block text-sm font-medium text-gray-700 mb-2">Contenido Post</label>
            <textarea name="contenido" id="cont"
                class="px-2 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md">{{$post->contenido}}</textarea>
            @error('contenido')
                <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        <div class="mt-2">
            <label for="cat" class="block text-sm font-medium text-gray-700 mb-2">Categoría Post</label>
            <select name="category_id"
                class=" py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md">
                @foreach ($categorias as $item)
                    <option value="{{ $item->id }}" @if($item->id==$post->category_id) selected @endif>{{ $item->nombre }}</option>
                @endforeach
            </select>

        </div>

        <div class="mt-3">
            <p class="block text-sm font-medium text-gray-700 mb-2">Etiquetas</p>
            
            @foreach ($tags as $tag)
                &nbsp;<label class="font-semibold" for="{{ $tag->id }}">
                    <input type="checkbox" id="{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" @if(in_array($tag->id, $array)) checked @endif>
                    {{ $tag->nombre }}
            @endforeach
            @error('tags')
                <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4"> 
            <div>
                <div class="mb-3">
                  <label for="image" class="form-label inline-block mb-2 text-gray-700">Imagen Post</label>
                  <input class="form-control
                  block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  m-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="image" name="image" accept="image/*">
                </div>
            </div>
            <div>
                <img src="{{asset("storage/".$post->image)}}" class="bg-cover bg-center" id="img">
            </div>
        </div>
        @error('image')
        <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
        @enderror
<div class="mt-2">
    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><i
            class="fas fa-edit"></i> Editar</button>
    <a href="{{ route('posts.index') }}"
        class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-backward"></i>
        Regresar</a>
</div>
</form>
</div>
<script>
    //Cambiar imagen 
    document.getElementById("image").addEventListener('change', cambiarImagen);
    function cambiarImagen(event){
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload=(event)=>{
            document.getElementById("img").setAttribute('src', event.target.result)
        };
        reader.readAsDataURL(file);

    }
</script>
@endsection