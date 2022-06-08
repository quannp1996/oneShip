<?php

namespace App\Containers\Authentication\Events\Admin\Handlers;

use App\Containers\Authentication\Events\Admin\Events\ForgotPasswordEvent;
use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Bizfly\Actions\Mail\StoreMailCronAction;
use Carbon\Carbon;

class ForgotPasswordEmailHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(ForgotPasswordEvent $event)
    {
        $mailSubject = sprintf('THAY ĐỔI MẬT KHẨU QUẢN TRỊ');
        $mailContent = view('authentication::Email.reset_password', [
            'link' => route('get_admin_reset_form', [
                'token' => encrypt($event->passwordReset->token),
                'email' => $event->user->email
            ])
        ])->render();
        $mailCronData[] = [
            'email' => $event->user->email,
            'receive_id' => $event->user->id,
            'receive_model' => get_class($event->user),
            'html' => preg_replace('~[\r\n]+~', '', $mailContent),
            'subject' => $mailSubject,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        app(StoreMailCronAction::class)->run($mailCronData);
    }
}
