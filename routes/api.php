<?php

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tags', function (Request $request) {
    $term = $request->term ?? ''; // Obtiene el término de búsqueda de la solicitud

    $tags = Tag::select('name')
        ->where('name', 'LIKE', '%'. $term . '%')
        ->limit(10)
        ->get()
        ->map(function($tag){ // Mapea los resultados (LOS RECORRE COMO UN BUCLE)
            return [
                'id' => $tag->name,
                'text' => $tag->name,
            ];
        });
    return $tags; // Devuelve los resultados en formato JSON
})->name('api.tags.index');
