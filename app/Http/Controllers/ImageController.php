<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request){
        
        // $path = Storage::put('images', $request->upload);
        // return[
        //     'url' => 'https://t3.ftcdn.net/jpg/03/45/05/92/240_F_345059232_CPieT8RIWOUk4JqBkkWkIETYAkmz2b75.jpg', //Storage::url($path)
        // ];

        $path = Storage::put('images', $request->file('upload'));
        return [
            'url' => Storage::url($path)
        ];
    }
}
