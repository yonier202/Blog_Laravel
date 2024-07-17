<?php

use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::post('images/upload', [ImageController::class, 'upload'])
    ->name('images.upload');

Route::get('prueba', function () {

    // $path = 'posts/i9coIQN3eUjQTb1XVVDFnn5I29HGBrmMGlECg8MR.png';

    // if (Storage::exists($path)) { //verifica si exite en storage()
    //    $path = str_replace('.png', '-copia.png', $path) ?? str_replace('.jpeg', '-copia.jpeg', $path) ;
    // }

    // return $path;
    //////////////////////////////////////////////////////////////////////////////

    //COPIAR ARCHIVOS DE UN LUGAR A OTRO

    // $path = 'posts/VERDE SOLO HAY UNO.JPEG';
    // $target = 'posts2/VERDE SOLO HAY UNO.JPEG';

    // Storage::copy($path,$target);

    // return 'El archivo ha sido copiado';

     //////////////////////////////////////////////////////////////////////////////

    //Mover ARCHIVOS DE UN LUGAR A OTRO

    // $path = 'posts2/VERDE SOLO HAY UNO.JPEG';
    // $target = 'posts3/VERDE SOLO HAY UNO.JPEG';

    // Storage::move($path,$target);

    // return 'El archivo ha sido movido';

     //////////////////////////////////////////////////////////////////////////////
     //ELIMINAR ARCHIVOS

    // $path = 'posts3/VERDE SOLO HAY UNO.JPEG';
    // Storage::delete($path);

    // return 'El archivo ha sido eliminado';

     //////////////////////////////////////////////////////////////////////////////
     //OBTENER EL TAMANO DE UN ARCHIVO

    // $path = 'posts/i9coIQN3eUjQTb1XVVDFnn5I29HGBrmMGlECg8MR.png';
    // $size = Storage::size($path);

    // return $size;

     //////////////////////////////////////////////////////////////////////////////
     //OBTENER LA URL DE UN ARCHIVO

    // $path = 'posts/i9coIQN3eUjQTb1XVVDFnn5I29HGBrmMGlECg8MR.png';
    // $url = Storage::url($path);

    // return $url;

     //////////////////////////////////////////////////////////////////////////////
     //OBTENER LA RUTA COMPLETA DE UN ARCHIVO

    // $path = 'posts/i9coIQN3eUj
    // $url = Storage::path($path);

    // return $url;

     //////////////////////////////////////////////////////////////////////////////
     //OBTENER EL CONTENIDO DE UN ARCHIVO

    // $path = 'posts/i9coIQN3eUjQTb1XVVDFnn5I29HGBrmMGlECg8MR.png';
    // $contents = Storage::get($path);

    // return $contents;

     //////////////////////////////////////////////////////////////////////////////
     //CREAR CARPETAS

    // $path = 'posts/subcarpeta';
    // Storage::makeDirectory($path);

    // return 'Carpeta creada';

     //////////////////////////////////////////////////////////////////////////////
     //ELIMINAR CARPETAS

    // $path = 'posts/subcarpeta';
    // Storage::deleteDirectory($path);

    // return 'Carpeta eliminada';

     //////////////////////////////////////////////////////////////////////////////
     //RENOMBRAR CARPETAS

    // $path = 'posts/subcarpeta';
    // Storage::rename($path, 'posts/nueva_subcarpeta');

    // return 'Carpeta renombrada';

     //////////////////////////////////////////////////////////////////////////////
     //LISTAR CARPETAS Y ARCHIVOS

    // $directories = Storage::directories('posts');
    // $files = Storage::files('posts');

    // return [
    //     'directories' => $directories,
    //     'files' => $files,
    // ];

     //////////////////////////////////////////////////////////////////////////////
    //LISTAR CARPETAS CON SU CONTENIDO

    // $directories = Storage::directories();
    // $directories2 = Storage::directories('posts');

    // $contents = [];

    // foreach ($directories as $directory) {
    //     $contents[$directory] = Storage::allFiles($directory);
    // }

    // return $contents;

    //////////////////////////////////////////////////////////////////////////////
    //retona el patch de todos los archivos
    // return Storage::files('posts');
    // return Storage::allFiles('posts'); //retorna todos hasta los que estan en subcarpetas
    /////////////////////////////////
    // return Storage::allDirectories('posts'); //retorna todas las carpetas en la raiz y en las subcarpetas

    ///////////////////////////////////////////////////////////
    //DESCARGAR IMAGEN
    return Storage::download('posts/VERDE SOLO HAY UNO.jpeg'); //descargar imagen


});
