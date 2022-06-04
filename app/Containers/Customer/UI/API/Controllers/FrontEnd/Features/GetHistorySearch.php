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

use App\Containers\Customer\UI\API\Requests\FrontEnd\GetHistorySearchRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\HistorySearchTransformer;
use App\Containers\Customer\Actions\FrontEnd\CustomerSearch\GetKeySearchByCustomerAction;
use Illuminate\Support\Facades\Cookie;



trait GetHistorySearch
{
    public $data = [];
    public function getHistorySearch(GetHistorySearchRequest $request)
    {
        // dd($this->user->id);
        if(!empty($this->user->id)){
            $historySearch=app(GetKeySearchByCustomerAction::class)->run(
                $this->user->id
               );
            $historySearch= $this->transform($historySearch,HistorySearchTransformer::class,[], []);
            $this->data['keySearch']= isset($historySearch['data']) ? $historySearch['data'] : [];
        }
        else{
            $arrKeySearch=[];
            $arr = Cookie::get('arrKeySearch');
            if(!empty($arr)){
                $i=0;
               krsort($arr);
                foreach($arr as $val){
                    $key=explode('|',\Crypt::decryptString($val));
                    $arrKeySearch[$i]['key_search']=$key[1];
                    $i++;
                }
                $this->data['keySearch']=$arrKeySearch;
            }
        }
        return $this->data;
    }
}
