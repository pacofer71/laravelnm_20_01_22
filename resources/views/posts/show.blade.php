@extends('layouts.uno')
@section('titulo')
    Detalle Post
@endsection
@section('cabecera')
Detalle Post
@endsection
@section('contenido')
<div class="mx-auto w-96  rounded overflow-hidden shadow-lg">
    <img class="w-full" src="{{Storage::url($post->image)}}" alt="Sunset in the mountains">
    <div class="px-6 py-4">
      <div class="font-bold text-xl mb-2">{{$post->titulo}}</div>
      <p class="text-gray-700 text-lg">
        {{$post->resumen}}
      </p>
      <p class="text-gray-500 text-base">
        {{$post->contenido}}
      </p>
    </div>
    <div class="px-6 pt-4 pb-2">
      @foreach($post->tags as $tag)
     
      <a href="{{route('posts.index1', $tag)}}" class="text-gray-700 inline-block px-3 h-6 rounded-full"
      style="background-color:{{ $tag->color }}">#{{$tag->nombre}}</a>
      @endforeach
  </div>
@endsection