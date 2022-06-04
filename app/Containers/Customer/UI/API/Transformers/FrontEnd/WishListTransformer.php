<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-18 15:28:43
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 15:35:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Transformers\FrontEnd;

use App\Containers\Product\UI\API\Transformers\FrontEnd\ProductListTransformer;


class WishListTransformer extends ProductListTransformer
{
  
    public function transform($wishList)
    {
        $prd=$wishList->product;
        $response = parent::transform($prd);
        return $response;
    }
    public function includeSpecialTags($wishList)
    {
        $prd=$wishList->product;
        return parent::includeSpecialTags($prd);
    }

    public function includeBrand($wishList) {
        $prd=$wishList->product;
        return parent::includeBrand($prd);
    }
}
