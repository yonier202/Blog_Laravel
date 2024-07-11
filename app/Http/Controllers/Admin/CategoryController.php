<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $categories = Category::latest('id')->paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'], //validatcion
        ]);

        Category::create($request->all());  //guardar en la bd

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Categoría creada correctamente.'
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required','string','max:255'], //validatcion
        ]);

        $category->update($request->all());  //actualizar en la bd

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Categoría actualizada correctamente.'
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {   
        $post = Post::where('category_id', '=', $category->id)->exists(); //si existe un post vinculado con esta categoria
        
        if ($post) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No se puede eliminar la categoría debido a que hay posts vinculados.'
            ]);
            return redirect()->route('admin.categories.edit', $category);

        }else{

            $category->delete();

            session()->flash('swal', [
                'icon' =>'success',
                'title' => 'Éxito',
                'text' => 'Categoría eliminada correctamente.'
            ]);

            return redirect()->route('admin.categories.index');
        }


    }
}
