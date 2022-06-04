<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 22:40:42
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-13 12:09:10
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions\FrontEnd;

use Apiato\Core\Foundation\FunctionLib;
use Apiato\Core\Foundation\ImageURL;
use App\Ship\Parents\Actions\Action;
use Carbon\Carbon;

class UpdateInfoCustomerAction extends Action
{
    public function run($data)
    {
        $customer = auth()->guard(config('auth.guard_for.frontend'))->user();
        $customer->fullname = $data['fullname'] ?? $customer->fullname;
        $customer->gender = !empty($data['gender']) ? $data['gender'] : $customer->gender;
        $customer->email = $data['email'] ?? $customer->email;
        $customer->phone = $data['phone'] ?? $customer->phone;
        $customer->address = $data['address'] ?? $customer->address;
        $customer->province = $data['province'] ?? $customer->province;
        $customer->district = $data['district'] ?? $customer->district;
        $customer->ward = $data['ward'] ?? $customer->ward;
        $customer->date_of_birth = !empty($data['date_of_birth']) ? Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($data['date_of_birth'])) : $customer->date_of_birth;

        $customer->save();

        return $customer;
    }
}