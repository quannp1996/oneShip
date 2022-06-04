<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-01 14:57:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-24 00:17:41
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Customer\UI\API\Requests\FrontEnd\AddWishListRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\CustomerListTransformer;
use App\Containers\Customer\Actions\FrontEnd\WishList\CreatedWishListAction;
use App\Containers\Customer\Actions\FrontEnd\WishList\DeleteWishListAction;
use App\Containers\Customer\Models\CustomerWishList;

trait AddWishList
{
    public function AddWishList(AddWishListRequest $request)
    {
        $data=$request->all();
        $data['customer_id']=$this->user->id;
        $checkExist=app(CustomerWishList::class)->checkProductExist($request->product_id,$this->user->id);
       
        if($checkExist){
            $wishList=app(DeleteWishListAction::class)->run($request->product_id);
            $is_add=false;
        }
        else{
            $wishList=app(CreatedWishListAction::class)->run($data);
            $is_add=true;
        }
        return response()->json(['success'=>true,'message'=>'Bạn đã thêm sản phẩm yêu thích thành công','is_add'=>$is_add]);
    }
}
