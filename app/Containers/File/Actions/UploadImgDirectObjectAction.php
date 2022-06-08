<?php

namespace App\Containers\File\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class UploadImgDirectObjectAction.
 *
 */
class UploadImgDirectObjectAction extends Action
{
    public function run($image, $title, $folder_upload)
    {
        return Apiato::call('File@UploadImgDirectObjectTask', [$image, $title, $folder_upload]);
    }
}
