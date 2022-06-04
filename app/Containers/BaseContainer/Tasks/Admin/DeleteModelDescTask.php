<?php

namespace App\Containers\BaseContainer\Tasks\Admin;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteModelDescTask extends Task
{
    public function run($repositoryInstance, $id, $foreignKey = '')
    {
        try {
            $repositoryInstance->getModel()->where($foreignKey, $id)->delete();

        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
