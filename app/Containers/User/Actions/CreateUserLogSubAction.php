<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\SubAction;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateUserLogSubAction extends SubAction
{
    public function run(
        int $object_id = 0,
        $before = null,
        $after = null,
        string $note = '',
        string $model = ''
    ) {
        return Apiato::call('User@CreateUserLogTask', [
            $object_id,
            $before,
            $after,
            $note,
            $model
        ]);
    }
}
