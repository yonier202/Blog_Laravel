<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Jobs\ResizeImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $posts = Post::where('user_id', auth()->id())
        ->latest('id')->paginate(10);
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
        // if (!Gate::allows('author', $post)) {
        //     abort(403 , 'No tienes acceso PUTO');
        // }

        $this->authorize('author', $post); //AUTHORIZE LLAMA EL Gate y validar que solo se puedan editar los post asociados a el usuario

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
            'images' => 'nullable|image',
        ]);

        $data = $request->all();

        $tags = [];

        foreach ($request->tags ?? [] as $name) { //si no se envia nada, el array es vacio
            $tag = Tag::firstOrCreate([ //si no lo encuentra lo crea
                'name' => $name,
            ]);
            $tags[] = $tag->id;
        }

        $post->tags()->sync($tags); //almacenando en tabla taggable(relacion polimorfica)

        if ($request->file('image')) { //verifica si hay un file tipo imagen en el request
            
            if ($post->image_path) { //verificar si ya hay un valor almacenado
                Storage::delete($post->image_path); //si ya existe 1 (eliminala)
            }

            $fileName = $request->slug. '.' . $request->file('image')->getClientOriginalExtension(); //obtenemos el nombre del slug
            $data['image_path'] = Storage::putFileAs('posts', $request->image, $fileName); //(NOMBRE DE LA CARPETA, IMAGEN, NOMBRE DE LA IMAGEN) LO ACTUALIZA
            
            // $img = InterventionImage::make('storage/' . $data['image_path']); //abrir la imagen
            // $img->resize(1200, null, function ($constrain){
            //     $constrain->aspectRatio(); //toma el mismo alto de la imagen redimenzionada
            // });
            // $img->save('storage/' . $data['image_path'], 50, 'jpg'); //guardar la imagen redimensionada
            //JOBS
            ResizeImage::dispatch($data['image_path']); //le pasamos el parametro al job
            // $data['image_path'] = $request->file('image')->storeAs('posts', $fileName); //(nombre de la llave donde esta llegando el objeto/ store= la carpeta donde la va almacenar)
        }
        $post->update($data);

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
