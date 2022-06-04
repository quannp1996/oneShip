<?php

namespace App\Containers\Customer\Actions\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Events\ForgotPasswordEvent;
use App\Containers\Customer\Mails\CustomerForgotPasswordMail;
use App\Containers\Customer\Tasks\CreatePasswordResetTask;
use App\Containers\Customer\Tasks\FindCustomerByEmailTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class ForgotPasswordAction
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ForgotPasswordAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run(DataTransporter $data)
    {
        $customer = app(FindCustomerByEmailTask::class)->run($data->email);
        if ($customer){
            // generate token, password
            $generate = app(CreatePasswordResetTask::class)->run($customer);
            // send email
            ForgotPasswordEvent::dispatch($generate, $customer);
        }else{
            return __('site.emailchuaduocdangkytrenhethong');
        }



    }
}
