<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts=Post::orderBy('id', 'desc')
        ->titulo($request->titulo)
        ->categoryId($request->category_id)
        ->paginate(4);
        $categorias = Category::orderBy('nombre')->get();
        
        return view('posts.index', compact('posts', 'request', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias =  Category::orderBy('nombre')->get();
        $tags = Tag::orderBy('nombre')->get();
        return view('posts.create', compact('categorias', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo'],
            'resumen'=>['required', 'string', 'min:6'], 
            'contenido'=>['required', 'string', 'min:10'],
            'image'=>['required', 'image', 'max:1024'],
            'tags'=>['required']
        ]);
        //Hemos pasdo todas las validaciones, vamos a guardar
        //1.- Guardamos el post con su imagen
        if($request->file('image')){
            //se ha subido la imagen la almaceno físicamente
            $url = Storage::put('public/posts', $request->file('image'));
            // $url=public/posts/nombre.jpg
            //"posts/".basename($url) =>nombre.jpg
            $urlBuena="posts/".basename($url);
        }
        //guardo el post en la base de datos
        $post=Post::create($request->all());
        $post->update([
            'image'=>$urlBuena
        ]);
        //almacenamos en la tabla post_tag los tags de este post
        $post->tags()->attach($request->tags);
        //----
        return redirect()->route('posts.index')->with('mensaje', 'Post Creado');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags=Tag::orderBy('nombre')->get();
        $categorias = Category::orderBy('nombre')->get();
        $array=$array = $post->tags->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'tags', 'categorias', 'array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo,'.$post->id],
            'resumen'=>['required', 'string', 'min:6'], 
            'contenido'=>['required', 'string', 'min:10'],
            'image'=>['nullable', 'image', 'max:1024'],
            'tags'=>['required']
        ]);
        if($request->file('image')){
            //queremos cambiar la imagen
            //debemos borrar la imagen antigua
            Storage::delete("public/".$post->image);
            //se ha subido la imagen la almaceno físicamente
            $url = Storage::put('public/posts', $request->file('image'));
            // $url=public/posts/nombre.jpg
            //"posts/".basename($url) =>nombre.jpg
            $urlBuena="posts/".basename($url);
            $post->update($request->all());
            $post->update(['image'=>$urlBuena]);


        }
        else{
            //no queremos cambiar la imagen
            $post->update($request->all());
        }
        //Ahora asociamos a este post sus etuiquetas
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('mensaje', 'Post Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //1.- Borro la imagen asocida al post
        // $post->image = posts/nombre.jpg 	
        Storage::delete("public/".$post->image);
        //2.- Borro el post
        $post->delete();
        //3.-nos vamos a index
        return redirect()->route('posts.index')->with('mensaje', 'Post Borrado');

    }
}
