<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $posts = Post::latest('id')->paginate(10);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required|exists:categories,id'
        ]);
        
        $post = Post::create($request->all());

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Post creado correctamente.'
        ]);

        return redirect()->route('admin.posts.edit', $post);

       

    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
        // $tags= Tag::all();
        $categories = Category::all();  
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {   
        // return $request->tags;

        $request->validate([
            'title' =>'required',
            'slug' => 'required|unique:posts,slug,'.$post->id, //slug diferente al asignado
            'category_id' => 'required|exists:categories,id',
            'excerpt' => $request->published ? 'required' :'nullable', //si quieres publicar el articulo excerpt debe ser requerido
            'body' => $request->published ? 'required' :'nullable', //si quieres publicar el articulo body debe ser requerido
            'published' => 'required|boolean',
            'tags' => 'nullable|array',
        ]);

        $tags = [];

        foreach ($request->tags ?? [] as $name) { //si no se envia nada, el array es vacio
            $tag = Tag::firstOrCreate([ //si no lo encuentra lo crea
                'name' => $name,
            ]);
            $tags[] = $tag->id;
        }

        $post->tags()->sync($tags); //almacenando en tabla taggable(relacion polimorfica)

        $post->update($request->all());

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Post actualizado correctamente.'
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Post eliminado correctamente.'
        ]);

        return redirect()->route('admin.posts.index');
    }
}
