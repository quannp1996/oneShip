<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-21 16:06:09
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\Admin\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Settings\Actions\GetAllSettingsAction;
use App\Containers\BaseContainer\Enums\BaseEnum;
use App\Containers\Customer\Actions\UpdateCustomerRefRevenueAction;
use App\Containers\Customer\Actions\FindCustomerRefRevenueByOrderIdAction;
use App\Containers\Bizfly\Actions\Loyalty\SavePointReferralByLoyaltyAction;

class UpdateCustomerRefRevenueHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle($event)
    {
        try {
            $settings = app(GetAllSettingsAction::class)->run('Array', true);
            $data['status'] = BaseEnum::ACTIVE;
            $percent_point_referal= !empty($settings['intergrated']['percent_point_referal'])?$settings['intergrated']['percent_point_referal']:0;
            $data['point'] = round((($event->order->total_price + $event->order->fee_shipping-($event->order->point_value*$event->order->point_rate)) * $percent_point_referal) / 100);
            $data['id'] = $event->customerRefRevenue_id;
            app(UpdateCustomerRefRevenueAction::class)->run($data);
            $customerRefRevenue = app(FindCustomerRefRevenueByOrderIdAction::class)->run($event->order->id, ['order', 'customer', 'customerRef']);
            app(SavePointReferralByLoyaltyAction::class)->run($customerRefRevenue);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
