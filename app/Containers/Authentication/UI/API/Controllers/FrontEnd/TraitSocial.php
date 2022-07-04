<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-24 21:27:54
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-20 17:05:20
 * @ Description: Happy Coding!
 */


namespace App\Containers\Authentication\UI\API\Controllers\FrontEnd;

use Apiato\Core\Foundation\StringLib;
use App\Ship\Transporters\DataTransporter;
use App\Containers\Authentication\UI\API\Requests\LoginSocialRequest;
use App\Containers\Customer\Actions\FindOneCustomerByCondiationAction;

trait TraitSocial
{
    public function loginSocial(LoginSocialRequest $request, FindOneCustomerByCondiationAction $findOneCustomerByCondiationAction)
    {
        try{
            $user = $findOneCustomerByCondiationAction->run([
                'social_id' => $request->social_id,
                'social_provider' => $request->social_provider
            ]);
            if(!$user){
                $data = new DataTransporter([
                    'social_id' => $request->social_id,
                    'social_provider' => 'facebook',
                    'fullname' => $request->social_name,
                    'email' => sprintf('%sfacebook@gmail.com', $request->social_id),
                    'password' => StringLib::random(8),
                    'status' => 2
                ]);
                $user = app(StoreNewCustomerAction::class)->run($data);
            }
            if($user->status != 2) return $this->sendError('unauthorzie', '404', 'Tài khoản không được kích hoạt');
            $token = auth($this->guard)->login($user);
            return $this->sendResponse([
                'success' => true,
                'token' => $token
            ]);
        }catch(\Exception $e){
            return $this->sendError('unauthorize', 404, $e->getMessage());
        }
    }
}
