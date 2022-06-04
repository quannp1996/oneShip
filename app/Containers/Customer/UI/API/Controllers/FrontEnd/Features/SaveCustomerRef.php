<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-01 14:57:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-24 00:17:41
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Customer\UI\API\Requests\FrontEnd\SaveCustomerRefRequest;
use App\Containers\Customer\Actions\FrontEnd\SaveCustomerRefAction;
use App\Containers\Customer\Models\CustomerRef;
use Illuminate\Support\Facades\Cookie;

trait SaveCustomerRef
{
    public function saveCustomerRef(SaveCustomerRefRequest $request)
    {
        if(!empty($this->user->id)){
            $data=[];
            $data['ref_code']=$request->ref_code;
            $data['customer_id']=$this->user->id;
            $checkExist=app(CustomerRef::class)->checkCustomerRefExist($request->ref_code,$this->user->id);
            if(!$checkExist && $this->user->ref_code != $request->ref_code ){
                $customerRef=app(SaveCustomerRefAction::class)->run($data);
            }
            if(!empty(Cookie::get('customer_ref'))){
                Cookie::queue(Cookie::forget('customer_ref'));
            }
        }
        else{
            Cookie::queue('customer_ref', $request->ref_code ,2880 );
        }
        return response()->json(['success'=>true,'message'=>'Thành công']);
    }
}
