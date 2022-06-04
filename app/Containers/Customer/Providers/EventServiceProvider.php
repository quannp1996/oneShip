<?php

namespace App\Containers\Customer\Providers;

use App\Containers\Customer\Events\ForgotPasswordEvent;
use App\Containers\Customer\Events\Handlers\ForgotPasswordEmailHandler;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ForgotPasswordEvent::class => [
            ForgotPasswordEmailHandler::class
        ]
    ];

    public function boot() {
        parent::boot();
    }
}
