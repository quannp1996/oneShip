<?php

namespace App\Containers\File\Tasks;

use Apiato\Core\Foundation\ImageURL;
use App\Ship\Parents\Tasks\Task;

/**
 * Class UploadImageTask.
 */
class UploadImageTask extends Task
{
    public function run($request, $imageField, $title, $folder_upload)
    {
        $errorMsg = null;
        if ($request->hasFile($imageField)) {
            $image = $request->file($imageField);
            $checkTypeFile = ImageURL::checkTypeFile($image->getPathname());
            if ($image->isValid()) {
                if ($checkTypeFile == true) {
                    $fname = ImageURL::makeFileName($title, $image->getClientOriginalExtension());
                    if (!$fname || empty($fname)) {
                        $errorMsg = 'Upload ảnh lên server thất bại!';
                    }else{
                        $image = ImageURL::upload($image, $fname, $folder_upload);
                    }
                } else {
                    $errorMsg = 'Upload ảnh lên server sai định dạng!';
                }
            } else {
                $errorMsg = 'Upload ảnh thất bại!';
            }
        }
        return ['error' => !empty($errorMsg),'msg' => @$errorMsg ?: 'Success', 'fileName' => @$fname];
    }
}
