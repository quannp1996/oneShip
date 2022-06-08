<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-16 13:11:38
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderItemRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Exception;

class CreateOrderItemsTask extends Task
{
    protected $items = [], $orderId = 0;
    protected $repository;

    public function __construct(OrderItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            $dataCreate = $this->convertItems();

            $this->repository->getModel()->insert($dataCreate);
        } catch (Exception $e) {
            throw $e;
            // throw new CreateResourceFailedException();
        }
    }

    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    private function convertOptions(array $options)
    {
        return json_encode($options);
    }

    private function convertSpecialOffers(array $specialOffers)
    {
        return json_encode($specialOffers);
    }

    private function convertItems()
    {
        $dataCreate = [];

        foreach ($this->items as $itemCart) {
            $dataCreate[] = $this->returnItem($itemCart);

            if(isset($itemCart['attachProducts']) && $itemCart['attachProducts']) {
                foreach($itemCart['attachProducts'] as $attach) {
                    $dataCreate[] = $this->returnItem($attach->toArray(),$itemCart['variantId']);
                }
            }
        }
        
        return $dataCreate;
    }

    private function returnItem($item, $parentId = 0) {
        return [
            'order_id' => $this->orderId,
            'variant_parent_id' => $parentId,
            'product' => @$item['product'],
            'quanlity' => @$item['quanlity'],
            'price' => @$item['price'],
            'created_at' => Carbon::now(),
        ];
    }
}
