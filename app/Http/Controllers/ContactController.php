<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('contacts.index');
    }

    public function store(Request $request){

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if ($request->hasFile('file')) { //verifica si hay adjunto un archivo
            $data['file'] = $request->file->store('contact'); //almecena en el directori contact y devuelve su ruta
        }
        
        Mail::to('yonier202@gmail.com')
        ->send(new ContactMailable($data));

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Post enviado correctamente.'
        ]);

        return back();
    }
}
