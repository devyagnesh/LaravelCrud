<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class ImageUploadService
{
    public function upload(UploadedFile $file, $path)
    {
        $uniqueName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    
        $file->move(public_path($path), $uniqueName);
    
        return $uniqueName;
    }
    
}
