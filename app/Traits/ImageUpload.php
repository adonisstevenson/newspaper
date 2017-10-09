<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;

trait ImageUpload{

	public function uploadNewsPhoto($image, $oldPath = null){

		if(!is_null($oldPath)){
			Storage::disk('public')->delete('news_photo/'.$oldPath);
		}

        $filename = time() . '.' . $image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());
        $img->resize(1366, 768);
        $img->stream();

        Storage::disk('public')->put('news_photo'.'/'.$filename, $img, 'public');
        
        return $filename;
	}

}