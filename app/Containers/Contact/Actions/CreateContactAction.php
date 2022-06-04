<?php

namespace App\Containers\Contact\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Contact\Models\ContactField;
use Illuminate\Support\Facades\DB;

class CreateContactAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'shop_name', 'email', 'phone'
        ]);
        $contact = Apiato::call('Contact@CreateContactTask', [$data]);
        $dataFields = $request->field;
        $insertData = [];
        if(!empty($dataFields)){
            foreach($dataFields AS $key => $field){
                $insertData[] = [
                    'contact_id' => $contact->id,
                    'field_id' => $key,
                    'value' => $field
                ];
            }
            ContactField::insert($insertData);
        }
        return $contact;
    }
}
