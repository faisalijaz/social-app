<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * @param $file
     * @return string
     */
    public static function saveImage($file)
    {
        if (!is_null($file)) {

            $filenameWithExt = $file->getClientOriginalName();
            #Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            #Get just Extension
            $extension = $file->getClientOriginalExtension();

            #Filename To store
            $fileNameToStore = $filename . "_" . time() . "." . $extension;

            #Upload Image
            $path = $file->storeAs("public/image", $fileNameToStore);

        } else {
            $fileNameToStore = "noimage.jpg";
        }

        return $fileNameToStore;
    }

    /**
     * @param null $image
     * @return string
     */
    public static function getImageUrl($image = null)
    {
        if ($image) return "/storage/image/" . $image;

        return "/storage/image/no-image.jpg";
    }
}
