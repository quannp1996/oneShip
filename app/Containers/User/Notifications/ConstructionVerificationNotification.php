<?php

namespace App\Containers\User\Notifications;

use App\Ship\Parents\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

/**
 * Class ConstructionVerificationNotification
 */
class ConstructionVerificationNotification extends Notification
{
    protected $notificationMessage;

    // Canbe: text, Model Data Like: User, Customer... to make message at line 22
    public function __construct($notificationMessage)
    {
        $this->notificationMessage = $notificationMessage;
    }

    public function toDatabase($notifiable) {
        $message = __('user::message.construction_accept', [
            'object_name' => $notifiable->email,
            'object_receive_name' => $this->notificationMessage,
            'link' => ''
        ]);
        
        return [
            'message' => $message,
            'object_trigger' => $notifiable
        ];
    }
} // End class
