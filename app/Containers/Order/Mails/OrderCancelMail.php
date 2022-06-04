<?php

namespace App\Containers\Order\Mails;

use App\Containers\Order\Models\Order;
use App\Ship\Parents\Mails\Mail;
use Illuminate\Bus\Queueable;

class OrderCancelMail extends Mail
{
    use Queueable;

    protected $order;

    protected $settings;

    protected $subscriber;

    /**
     * NewConstructionForSubscribersMail constructor.
     *
     * @param $recipient : List subscribers email as a string (Eg: nguyenvana@gmail.com,phamvanb@hotmail.com)
     */
    public function __construct(Order $order, array $settings=[])
    {
        $this->order = $order;
        $this->settings = $settings;
       
    }

    public function build()
    {
        return $this->view('order::order-cancel')
            ->with([
                'order' => $this->order,
                'settings' => $this->settings,
            ]);
    }
}
