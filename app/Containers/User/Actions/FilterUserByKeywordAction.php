<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class FilterUserByKeywordAction extends Action
{
    public function run(DataTransporter $dataTransporter, array $column=['*'])
    {
        $users = Apiato::call('User@FilterUserByKeywordTask', [], [
          ['selectFields' => [$column]]
        ]);
        return $users;
    }
}
