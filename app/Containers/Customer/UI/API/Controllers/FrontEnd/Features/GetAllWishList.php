<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-01 14:57:39
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-08-24 00:17:41
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Customer\UI\API\Requests\FrontEnd\GetAllWishListRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\WishListTransformer;
use App\Containers\Customer\Actions\FrontEnd\WishList\GetAllWishListByCustomerAction;



trait GetAllWishList
{
    public $data = [];
    public function getAllWishList(GetAllWishListRequest $request)
    {
        // dd($this->user->id);
        $wishList=app(GetAllWishListByCustomerAction::class)->run($this->user->id,'favorite',['product','product.desc']);
     
        $wishList= $this->transform($wishList,WishListTransformer::class,[], [], 'wish-List');
        $this->data['wish_list']= isset($wishList['data']) ? $wishList['data'] : [];
        $this->data['pagination'] = isset($wishList['meta']['pagination']) ? $wishList['meta']['pagination'] : [];
        return $this->data;
    }
}
