<?php

namespace App\Containers\Authentication\Events\Admin\Events;

use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;
use App\Containers\Authentication\Models\PasswordReset;
use App\Containers\User\Models\User;
use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordEvent extends Event implements ShouldHandleNow
{
    use SerializesModels;

    public $passwordReset;
    

    public function __construct(PasswordReset $passwordReset, User $user)
    {
        $this->passwordReset = $passwordReset;
        $this->user = $user;
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
