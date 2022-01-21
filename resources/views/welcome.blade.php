@extends('layouts.uno')
@section('titulo')
    Inicio
@endsection
@section('cabecera')
    Posts Al-Andalus
@endsection
@section('contenido')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
        @foreach ($posts as $item)
            <article class="w-full h-60 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" style="background-image:url({{ Storage::url($item->image) }})">
                <div class="w-full h-full px-8 flex flex-col justify-center">
                    <div>
                        @foreach ($item->tags as $tag)
                            <a href="#" class="text-gray-700 inline-block px-3 h-6 rounded-full"
                                style="background-color:{{ $tag->color }}">{{ $tag->nombre }}</a>
                        @endforeach
                    </div>
                    <h1 class="text-xl text-white leading-8 font-bold">
                        <a href="{{ route('posts.show', $item) }}">{{ $item->titulo }}</a>
                    </h1>
                </div>
            </article>
        @endforeach
    </div>
    <div class=mt-2>
        {{ $posts->links() }}
    </div>
@endsection
