<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:46:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 23:02:26
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Requests\FrontEnd\AddressBook;

use App\Containers\Customer\Enums\CustomerAddressBookStatus;
use App\Containers\Customer\Models\CustomerAddressBook;
use App\Containers\Location\Models\City;
use App\Containers\Location\Models\District;
use App\Containers\Location\Models\Ward;
use App\Ship\Parents\Requests\Request;

class UpdateAddressRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            // 'pickingAddress' => ['required',new NewAddressRule()]
            'id' => ['required','exists:'.CustomerAddressBook::getTableName().',id,status,'.CustomerAddressBookStatus::ACTIVE],
            'name' => ['required'],
            'phone' => ['required','numeric','regex:/^(0)[0-9]{9}$/'],
            'province_id' => ['required','numeric','exists:'.City::getTableName().',id'],
            'district_id' => ['required','numeric','exists:'.District::getTableName().',id'],
            'ward_id' => ['required','numeric','exists:'.Ward::getTableName().',id'],
            'is_on_working_time' => ['required'],
            'address'  => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('site.nhaphotencuaban'),

            'phone.required' => __('site.haynhapsodienthoai'),
            'phone.numeric' => __('site.sodienthoaikhongdungdinhdang'),
            'phone.regex' => __('site.sodienthoaikhongdungdinhdang'),
            'province_id.required' => __('site.chontinhthanh'),
            'province_id.exists' => __('site.chontinhthanh'),

            'district_id.required' => __('site.chonquanhuyen'),
            'district_id.exists' => __('site.chonquanhuyen'),

            'ward_id.required' => __('site.chonxaphuong'),
            'ward_id.exists' => __('site.chonxaphuong'),

            'is_on_working_time.required' => __('site.chonthoidiemgiao'),

            'address.required' => __('site.haynhapdiachi'),
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return true;
        // return auth()->guard(config('auth.guard_for.frontend'))->check();
    }
}
