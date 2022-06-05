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

use App\Containers\Order\Models\Order;
use App\Ship\Parents\Requests\Request;
use App\Containers\Customer\Models\Customer;
use App\Containers\Order\Enums\OrderCancelReason;


class CancelOrderRequest extends Request
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
            "id" => ['required', 'exists:' . Order::getTableName()],
        ];
    }

    public function messages()
    {
        return [
            // 'order_id.required' => __('site.chonphuongthucthanhtoan'),
            // 'order_id.exists' => __('site.chonphuongthucthanhtoan'),
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $user = auth()->guard(config('auth.guard_for.frontend'))->user();
        $this->merge([
            'username' => $user->user_name ?? '',
            'action_key' => 'cancel',
            'object_model' => Customer::class,
            'object_id' => $user->id,
            'ip' => request()->ip(),
            'note' => sprintf('%s đã huỷ đơn hàng này. Lý do huỷ: %s; %s', $user->fullname, OrderCancelReason::TEXT[$this->reason_key], $this->reason),
            'order_action' => 'cancel',
            'message' => $user->fullname . ': Huỷ đơn do: ' . OrderCancelReason::TEXT[$this->reason_key] . '; ' . $this->reason
        ]);
    }
}
