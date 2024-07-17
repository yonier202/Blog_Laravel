<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intervention\Image\Facades\Image as InterventionImage;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $image_path;
    /**
     * Create a new job instance.
     */
    public function __construct($image_path)
    {
        $this->image_path = $image_path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $image = Storage::get($this->image_path);
        $img = InterventionImage::make($image); //abrir la imagen
        $img->resize(1200, null, function ($constrain){
                $constrain->aspectRatio(); //toma el mismo alto de la imagen redimenzionada
            });
        // $img->save('storage/' . $this->image_path, 50, 'jpg'); //guardar la imagen redimensionada
        $img->stream('jpg', 50);
        Storage::put($this->image_path, $img); //guardar la imagen redimensionada en storage()
    }
}

//