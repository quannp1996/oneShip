<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Models\Customer;
use App\Containers\Customer\Values\TotalFollowValue;
use Illuminate\Support\Arr;

class ToggleFollowContractorAction extends Action
{
    public function run(Request $request)
    {   
        $followData = Arr::only($request->all(), ['customer_id', 'type', 'follower_id']);
        $contractorsFollows = Apiato::call('Customer@FindFollowContractorByDataTask', [$followData]);
        
        if ($contractorsFollows->isNotEmpty()) {
            $follow = Apiato::call('Customer@DetachFollowContractorTask', [$followData]);
        }else {
            $follow = Apiato::call('Customer@AttachFollowContractorTask', [$followData]);
        }

        $totalFollow = Apiato::call('Customer@CountFollowContractorTask', [$followData]);
        return new TotalFollowValue($follow, $totalFollow);
    }
}
