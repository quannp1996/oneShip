<?php

namespace App\Containers\Customer\Events;

use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;
use App\Containers\Authentication\Models\PasswordReset;
use App\Containers\Customer\Models\Customer;
use App\Ship\Parents\Events\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordEvent extends Event implements ShouldQueue
{
    use SerializesModels;

    public $passwordReset;
    public $customer;


    public function __construct(PasswordReset $passwordReset, Customer $customer)
    {
        $this->passwordReset = $passwordReset;
        $this->customer = $customer;
    }

    public function handle()
    {
        // Do some handling here
    }

    public function broadcastOn()
    {
        return [];
    }
}
