<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke(){

        // return request('categories');

        $categories = Category::all();

        $posts = Post::where('published', true)
        ->filter()  // Aquí se aplica el query scope `filter`
        ->orderBy('published_at', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();  // Mantiene los parámetros de filtros en la paginación
        return view('welcome', compact('posts', 'categories'));
    }
}
