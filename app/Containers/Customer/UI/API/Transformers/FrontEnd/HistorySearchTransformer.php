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

use App\Ship\Parents\Transformers\Transformer;


class HistorySearchTransformer extends Transformer
{
  
    public function transform($historySearch)
    {
        $response = [
            'key_search' => @$historySearch->key_search,
           
        ];
        return $response;
    }
    
}