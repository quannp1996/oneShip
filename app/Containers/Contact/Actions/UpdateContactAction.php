<?php

namespace App\Containers\Contact\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateContactAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $contact = Apiato::call('Contact@UpdateContactTask', [$request->id, $data]);

        return $contact;
    }
}
