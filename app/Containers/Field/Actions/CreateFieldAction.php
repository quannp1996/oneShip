<?php

namespace App\Containers\Field\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateFieldAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
           'lable', 'placeholder', 'sort_order', 'status', 'is_required'
        ]);
        $field = Apiato::call('Field@CreateFieldTask', [$data]);
        return $field;
    }
}
