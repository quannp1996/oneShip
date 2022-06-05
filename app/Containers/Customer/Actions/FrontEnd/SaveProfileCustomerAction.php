<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-24 22:40:42
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-10-13 12:09:10
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions\FrontEnd;

use Apiato\Core\Foundation\FunctionLib;
use Apiato\Core\Foundation\ImageURL;
use App\Ship\Parents\Actions\Action;
use Carbon\Carbon;

class SaveProfileCustomerAction extends Action
{
    public function run($request)
    {
        $customer = auth()->guard(config('auth.guard_for.frontend'))->user();
        $customer->fullname = $request->fullname ?? $customer->fullname;
        if (!empty($request->password_new) && !empty($request->password) && $request->password_new != '') {
            $customer->password = bcrypt($request->password_new) ?? $customer->password;
        }
        $customer->gender = $request->gender ?? $customer->gender;
        $customer->date_of_birth = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($request->date_of_birth)) ?? $customer->date_of_birth;
        if ($customer->phone == '' && $request->phone != '' && $customer->type_check != 2) {
            $customer->phone = $request->phone;
            if ($request->has('type_check')) {
                $customer->type_check = 2;
            }
        }
        // process image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $fname = ImageURL::makeFileName($request->fullname, $image->getClientOriginalExtension());
                $image = ImageURL::upload($image, $fname, 'customer');
                if ($image) {
                    $customer->avatar = $fname;
                } else {
                    return redirect()->back()->withInput()->withErrors(['image' => 'Upload ảnh lên server thất bại!']);
                }
            } else {
                return redirect()->back()->withInput()->withErrors(['image' => 'Upload ảnh thất bại!']);
            }
        }

        $customer->save();

        return $customer;
    }
}
