<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 14:45:44
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-26 11:10:42
 * @ Description: Happy Coding!
 */

namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Events\Admin\Events\ForgotPasswordEvent;
use App\Containers\Authentication\Events\Admin\Handlers\ForgotPasswordEmailHandler;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Admin
        ForgotPasswordEvent::class => [
            ForgotPasswordEmailHandler::class
        ]
    ];

    public function boot() {
        parent::boot();
    }
}
