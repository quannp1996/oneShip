<?php

namespace App\Ship\core\Traits\HelpersTraits;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

trait OTPTrait
{
    public function sendOtp(string $type, string $code, string $to){
        switch($type){
            case 'email':
                return $this->sendOtpViaEmail($code, $to);
            break;
            case 'phone': 
                return $this->sendOtpViaEmail($code, $to);
            break;
        }
    }

    public function sendOtpViaEmail($code, $to){
        $mailMetaData = [
            'to' => $to,
            'subject' => 'Your OTP Code',
            'html'  => '<p>Mã code của bạn là  <strong>'.$code.'</strong></p>'
        ];
        /**
        * Send OTP to Email
        */
        return Apiato::call('Bizfly@Mail\SendMailAction', [$mailMetaData]);
    }

    public function sendOtpViaPhone($code, $to){
        $mailMetaData = [
            'to' => $to,
            'subject' => 'Your OTP Code',
            'html'  => '<p>Mã code của bạn là  <strong>'.$code.'</strong></p>'
        ];
        /**
        * Send OTP to Phone
        */
        return Apiato::call('Bizfly@Mail\SendMailAction', [$mailMetaData]);
    }

    public function checkOtpCode(string $otpCode, string $userID){
        return Apiato::call('Authentication@CheckOTPCodeAction', [ new DataTransporter([
            'otp_code' => $otpCode,
            'user_id' => $userID
        ])]);
    }
} // End class

