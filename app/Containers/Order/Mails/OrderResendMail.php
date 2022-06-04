<?php

namespace App\Containers\Order\Mails;

use App\Ship\Parents\Mails\Mail;
use App\Containers\Order\Models\Order;
use Apiato\Core\Foundation\Facades\Apiato;
use Exception;

class OrderResendMail extends Mail
{
  // use Queueable;

  protected $order;

  public function __construct(Order $order,array $settings=[])
  {
      $this->order = $order;
      $this->settings = $settings;
  }

  public function build()
  {
    // $mailSetting = Apiato::call('Settings@FindSettingByKeyAction', ['activity']);
    // $mailSetting = json_decode($mailSetting, true);
    // if (!empty($mailSetting)) {
    //   return $this->from($mailSetting['mail_from_address'], $mailSetting['mail_from_name'])
    //               ->view('order::order-resend')
    //               ->to($this->order->email, $this->order->fullname)
    //               ->with([
    //                   'order' => $this->order
    //               ]);
    // }

    // throw new Exception('Can not parse email setting', 422);

    return $this->view('order::order-resend')
    ->with([
        'order' => $this->order,
        'settings' => $this->settings,
    ]);
  }
} // End class
