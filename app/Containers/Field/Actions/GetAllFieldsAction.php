<?php

namespace App\Containers\Field\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Field\Tasks\GetAllFieldsTask;

class GetAllFieldsAction extends Action
{
    public function run(array $condition = [])
    {
        $fields = app(GetAllFieldsTask::class)->filter($condition)->run();
        return $fields;
    }
}
