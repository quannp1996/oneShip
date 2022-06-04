<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:44:12
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-08 22:31:53
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Customer\Actions\UpdateCustomerAction;
use App\Containers\Customer\UI\API\Requests\FrontEnd\EditCustomerInforRequest;
use App\Containers\Customer\UI\API\Requests\FrontEnd\UpdateAvatarCustomerInforRequest;
use App\Containers\Customer\UI\API\Requests\FrontEnd\UpdateCustomerInforRequest;
use App\Containers\Customer\UI\API\Requests\FrontEnd\UpdatePasswordCustomerRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\CustomerPrivateProfileTransformer;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Hash;

trait EditCustomerInfor
{
    public function editCustomerInfor(EditCustomerInforRequest $request)
    {
        die('xxx');
    }

    public function updateCustomerInfor(UpdateCustomerInforRequest $request, UpdateCustomerAction $updateCustomerAction)
    {
        $customer = $updateCustomerAction->run(new DataTransporter($request->merge([
            'id' => auth('api-customer')->id(),
        ])->only([
            'id', 'name', 'email', 'address', 'province', 'district', 'ward', 'gender', 'phone', 'date_of_birth'
        ])));

        return $this->transform($customer, CustomerPrivateProfileTransformer::class,[],  [
            'message' => 'Success',
            'status' => true
        ], 'data');
        
    }

    public function updateAvatar(UpdateAvatarCustomerInforRequest $request, UpdateCustomerAction $updateCustomerAction)
    {
        $dataTransporter = new DataTransporter([
            'id' => auth('customer')->id()
        ]);
        $this->uploadImage($dataTransporter, $request, 'avatar', 'avatar_'.auth('customer')->id(), 'customer');
        $customer = $updateCustomerAction->run($dataTransporter);
        return $this->transform($customer, CustomerPrivateProfileTransformer::class,[],  [
            'message' => 'Success',
            'status' => true
        ], 'data');
    }

    public function updatePassword(UpdatePasswordCustomerRequest $request, UpdateCustomerAction $updateCustomerAction){
        $user = auth('api-customer')->user();
        if(!Hash::check($request->password, $user->password)){
            return $this->sendError([
                'password' => ['Nhập lại mật khẩu không đúng']
            ], 422);
        }
        $dataTransporter = new DataTransporter([
            'password' => $request->password_2,
            'id' => $user->id
        ]);
        $customer = $updateCustomerAction->run($dataTransporter);
        return $this->transform($customer, CustomerPrivateProfileTransformer::class,[],  [
            'message' => 'Thay đổi mật khẩu thành công',
            'status' => true
        ], 'data');
    }
}
