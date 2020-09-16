<?php
namespace App\Helper;

class UploadHelper {
    public static function fileUpload($file, $path) {
        if ($file) {
            $filename = $file->getClientOriginalName();
            $img = $file->move(public_path($path), $filename);
            return $filename;
        }
        return null;
    }
}
