<?php

namespace App\Containers\File\Tasks;

use Apiato\Core\Foundation\ImageURL;
use App\Ship\Parents\Tasks\Task;

/**
 * Class UploadImgDirectObjectTask.
 */
class UploadImgDirectObjectTask extends Task
{
    public function run($image, $title, $folder_upload)
    {
        $errorMsg = null;
        if ($image->isValid()) {
            $checkTypeFile = ImageURL::checkTypeFile($image->getPathname());
            if ($image->isValid()) {
                if ($checkTypeFile == true) {
                    $fname = ImageURL::makeFileName($title, $image->getClientOriginalExtension());
                    $image = ImageURL::upload($image, $fname, $folder_upload);
                    if (!$image) {
                        $errorMsg = 'Upload ảnh lên server thất bại!';
                    }
                } else {
                    $errorMsg = 'Upload ảnh lên server sai định dạng!';
                }
            } else {
                $errorMsg = 'Upload ảnh thất bại!';
            }
        }
        return ['error' => !empty($errorMsg), 'msg' => $errorMsg ?: 'Success', 'fileName' => $fname];
    }
}
