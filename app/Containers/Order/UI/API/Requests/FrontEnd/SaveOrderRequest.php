<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-21 12:39:00
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-21 14:28:00
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Requests\FrontEnd;

use App\Containers\Customer\Enums\CustomerAddressBookStatus;
use App\Containers\Customer\Models\CustomerAddressBook;
use App\Containers\Settings\Enums\DeliveryTypeStatus;
use App\Containers\Settings\Enums\PaymentTypeStatus;
use App\Containers\Settings\Models\DeliveryType;
use App\Containers\Settings\Models\PaymentType;
use App\Ship\Parents\Requests\Request;

class SaveOrderRequest extends Request
{
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            "order_note" => ['nullable'],
            "payment_method" => ['required', 'exists:'.PaymentType::getTableName().',id,status,'.PaymentTypeStatus::ACTIVE],
            "delivery_method" => ['required','exists:'.DeliveryType::getTableName().',id,status,'.DeliveryTypeStatus::ACTIVE],
            "coupon" => ['nullable'],
            "coupon_value" => ['nullable'],
            "address_id" => ['required', 'exists:'.CustomerAddressBook::getTableName().',id,status,'.CustomerAddressBookStatus::ACTIVE],
            "shipping_fee" => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'payment_method.required' => __('site.chonphuongthucthanhtoan'),
            'payment_method.exists' => __('site.chonphuongthucthanhtoan'),

            'delivery_method.required' => __('site.chonphuongthucvanchuyen'),
            'delivery_method.exists' => __('site.chonphuongthucvanchuyen'),

            'address_id.required' => __('site.haynhapdiachi'),
            'address_id.exists' => __('site.haynhapdiachi'),
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }
}
