<?php

namespace App\Containers\File\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class UploadImageAction.
 *
 */
class UploadMultipleImageAction extends Action
{
    public function run($request, $imageField, $title, $folder_upload)
    {
        return Apiato::call('File@UploadMultipleImageTask', [$request, $imageField, $title, $folder_upload]);
    }
}
