<?php

namespace App\Containers\File\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class UploadImageAction.
 *
 */
class UploadImageAction extends Action
{
    public function run($request, $imageField, $title, $folder_upload)
    {
        return Apiato::call('File@UploadImageTask', [$request, $imageField, $title, $folder_upload]);
    }
}
