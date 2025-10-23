<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

trait FileUploadTrait
{
    public function fileUpload($file, string $folder)
    {
        $images = '';
        if (!File::isDirectory(public_path('uploads/' . $folder))) {
            mkdir('uploads/' . $folder);
        }
        if (is_array($file)) {
            $images = [];
            foreach ($file as $f) {
                if (in_array($f->getClientOriginalExtension(), ['png', 'jpg', 'jpeg', 'webp'])) {
                    $file_name = rand(10000000, 99999999) . '.webp';
                    $path = public_path('uploads/' . $folder . '/' . $file_name);
                    Image::make($f->getRealPath())->encode('webp', 100)->save($path);
                } else {
                    $file_name = rand(10000000, 99999999) . '.' . $f->getClientOriginalExtension();
                    $f->move(public_path('uploads/' . $folder), $file_name);
                }
                array_push($images, 'uploads/' . $folder . '/' . $file_name);
            }
        } else {

            if (in_array($file->getClientOriginalExtension(), ['png', 'jpg', 'jpeg', 'webp'])) {
                $file_name = rand(10000000, 99999999) . '.webp';
                $path = public_path('uploads/' . $folder . '/' . $file_name);
                Image::make($file->getRealPath())->encode('webp', 100)->save($path);
            } else {
                $file_name = rand(10000000, 99999999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/' . $folder), $file_name);
            }
            $images = 'uploads/' . $folder . '/' . $file_name;
        }

        return $images;
    }
    public function fileDelete($file): void
    {
        $file_path = public_path($file);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
    }
}
