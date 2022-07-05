<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: QuanNP - npquan1995@gmai.com
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

            $code = $this->makeCodeOrder(@$data['payment_type'], $object->id);

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
        return $data;
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
