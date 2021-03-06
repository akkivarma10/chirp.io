<?php

namespace App\Utils;

use Image;

class Utils
{
    public function fitAndSaveImage($user_id, $image, $width, $height, $location, $operation)
    {
        $image_name = $user_id.'_'.time().'.'.$image->getClientOriginalExtension();
        if ($image->getClientOriginalExtension() == 'gif') {
            $file = Image::make($image->getRealPath());
            copy($image->getRealPath(), $location.'/original_'.$image_name);
            copy($image->getRealPath(), $location.'/'.$image_name);
        }
        else {
            if ($operation == 'fit') {
                Image::make($image)->fit($width, $height, function ($constraint) {
                    $constraint->upsize();
                })->save($location.'/'.$image_name);
                Image::make($image)->save($location.'/original_'.$image_name);
            }
            else {
                Image::make($image)->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($location.'/'.$image_name);
                Image::make($image)->save($location.'/original_'.$image_name);
            }
        }
        return $image_name;
    }
}
