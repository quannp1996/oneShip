<?php

namespace App\Containers\File\Tasks;

use Apiato\Core\Foundation\ImageURL;
use App\Ship\Parents\Tasks\Task;

/**
 * Class UploadImageTask.
 */
class UploadMultipleImageTask extends Task
{
    public function run($request, $imageField, $title, $folder_upload)
    {
        $errorMsg = null;
        $fname = [];
        if ($request->hasFile($imageField)) {
            $images = $request->file($imageField);
            foreach($images AS $key => $image){
                $checkTypeFile = ImageURL::checkTypeFile($image->getPathname());
                if ($image->isValid()) {
                    if ($checkTypeFile == true) {
                        $fname[] = $imageName = ImageURL::makeFileName($title.'_'.$key.'_'.time(), $image->getClientOriginalExtension());
                        $image = ImageURL::upload($image, $imageName, $folder_upload, $err);
                        if (!$image){
                            $errorMsg = 'Upload ảnh lên server thất bại! '.$err;
                        }
                    } else {
                        $errorMsg = 'Upload ảnh lên server sai định dạng!';
                    }
                } else {
                    $errorMsg = 'Upload ảnh thất bại!';
                }
            }
        }
        return ['error' => !empty($errorMsg),'msg' => @$errorMsg ?: 'Success', 'fileName' => $fname];
    }
}
