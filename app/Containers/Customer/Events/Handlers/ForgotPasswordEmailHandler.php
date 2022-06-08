<?php

namespace App\Containers\Customer\Events\Handlers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Customer\Events\ForgotPasswordEvent;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordEmailHandler extends BaseFrontEventHandler implements ShouldQueue
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(ForgotPasswordEvent $event)
    {
        $messageBody = view('namphat::pc.email.forgot-password-passwordReset', ['password' => $event->passwordReset->pass_reset])->render();
        Mail::html($messageBody, function ($message) use($event) {;
            $message->to($event->customer->email);
            $message->subject('Quên mật khẩu');
        });
        // check for failures
        if (empty(Mail::failures())){
            DB::beginTransaction();
            try{
                Apiato::call('Customer@UpdateCustomerAction', [new DataTransporter(['id' => $event->customer->id, 'password' => $event->passwordReset->pass_reset])]);
                DB::commit();
            }catch(\Exception $e){
                throw $e;
                DB::rollBack();
            }
        }
    }
}
