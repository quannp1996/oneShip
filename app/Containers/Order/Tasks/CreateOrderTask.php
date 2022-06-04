<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-10 14:38:53
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Tasks;

use Apiato\Core\Foundation\StringLib;
use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Containers\Order\Enums\OrderStatus;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Exception;

class CreateOrderTask extends Task
{
    protected $repository, $inputData;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            $data = $this->mapData($this->inputData);

            $object = $this->repository->create($data);

            $code = $this->makeCodeOrder($data['payment_type'], $object->id);

            $data = [
                'code' => $code,
                'token_tracking' => $this->genTokenTracking($code),
            ];

            $object = $this->repository->update($data, $object->id);

            return $object;
        } catch (Exception $e) {
            throw $e;
            // throw new CreateResourceFailedException();
        }
    }

    public function setData(array $inputData): self
    {
        $this->inputData = $inputData;
        return $this;
    }

    private function mapData(array $data)
    {
        $mapData = [
            'customer_id' => isset($data['customer_id']) ? $data['customer_id'] : 0,
            'fullname' => isset($data['fullname']) ? $data['fullname'] : '',
            'email' => isset($data["email"]) ? $data["email"] : '',
            'phone' => isset($data['phone']) ? $data['phone'] : '',
            'note' => isset($data['note']) ? $data['note'] : '',
            'status' => isset($data['status']) ? $data['status'] : OrderStatus::NEW_ORDER,
            'total_price' => isset($data['total_price']) ? $data['total_price'] : 0,
            'total_gross' => isset($data['total_gross']) ? $data['total_gross'] : 0,
            'refund_value' => isset($data['refund_value']) ? $data['refund_value'] : 0,
            'total_discount_value' => isset($data['total_discount_value']) ? $data['total_discount_value'] : 0,
            'fee_shipping' => isset($data['fee_shipping']) ? $data['fee_shipping'] : 0,
            'point_value' => isset($data['point_value']) ? $data['point_value'] : 0,
            'point_rate' => isset($data['point_rate']) ? $data['point_rate'] : 0,
            'extra_fee' => isset($data['extra_fee']) ? $data['extra_fee'] : 0,
            'payment_type' => isset($data['payment_type']) ? $data['payment_type'] : 0,
            'payment_name' => isset($data['payment_name']) ? $data['payment_name'] : '',
            'delivery_type' => isset($data['delivery_type']) ? $data['delivery_type'] : 0,
            'order_from' => isset($data['order_from']) ? $data['order_from'] : 'web',
            'province_id' => isset($data['province_id']) ? $data['province_id'] : 0,
            'district_id' => isset($data['district_id']) ? $data['district_id'] : 0,
            'ward_id' => isset($data['ward_id']) ? $data['ward_id'] : 0,
            'eshop_shipping_id' => isset($data['eshop_shipping_id']) ? $data['eshop_shipping_id'] : '',
            'address' => isset($data['address']) ? $data['address'] : '',
            'address_id' => isset($data['address_id']) ? $data['address_id'] : 0,
            'coupon_value' => isset($data['coupon_value']) ? $data['coupon_value'] : 0,
            'coupon_code' => isset($data['coupon_code']) ? $data['coupon_code'] : '',
            'created_at' => Carbon::now(),
            // 'type' => 'contact',
        ];

        return $mapData;
    }

    private function makeCodeOrder($payment_type = 0, $id = 0, $number_of_characters = 10)
    {
        if (strlen($id) > 5) {
            $id = substr($id, 0, - (strlen($id) - 5));
        }

        $permitted_chars = '0123456789ABCEFGHJKLMNOPQYISTWZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';

        for ($i = 0; $i < $number_of_characters - strlen($payment_type . '' . $id); $i++) {
            $random_string .= $permitted_chars[mt_rand(0, $input_length - 1)];
        }
        return strtoupper('HA' . $payment_type . '' . $id . '' . $random_string);
    }

    private function genTokenTracking($code = '')
    {
        return sha1(uniqid('', true) . StringLib::random(35) . $code . microtime(true));
    }
}
