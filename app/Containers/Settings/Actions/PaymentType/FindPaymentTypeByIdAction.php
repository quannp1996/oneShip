<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-20 01:20:09
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\PaymentType;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class FindPaymentTypeByIdAction extends Action
{
    public function run($banner_id)
    {
        $data = Apiato::call('Settings@PaymentType\FindPaymentTypeByIdTask', [
            $banner_id,
            Apiato::call('Localization@GetDefaultLanguageTask'),
            ['with_relationship' => ['all_desc']]
        ]);

//        if ($data) {
//            $data->setRelation('all_desc', $data->all_desc->keyBy('language_id'));
//        }

        return $data;
    }
}
