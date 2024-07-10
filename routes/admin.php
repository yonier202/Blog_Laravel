<?php
    use Illuminate\Support\Facades\Route;

    Route::get('/admin', function () {

        //variables de session de un unico uso
        session()->flash('swal',[ 
            'type' => 'success',
            'title' => 'Éxito',
            'text' => 'Has accedido al panel de administración correctamente.'
        ]);

        return view('admin.dashboard');
    })->name('admin.dashboard');