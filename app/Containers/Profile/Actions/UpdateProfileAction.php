<?php 
namespace App\Containers\Profile\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateProfileAction extends Action{
    /**
     * @return mixed
     */
    public function run(DataTransporter $data)
    {

        $userData = [
            'avatar'               => $data->avatar ? $data->avatar :  Auth::user()->avatar,
            'password'             => $data->password ? Hash::make($data->password) : Auth::user()->password,
            'name'                 => $data->name,
            'gender'               => $data->gender,
            'birth'                => $data->birth,
            'phone'                => $data->phone,
            'social_token'         => $data->token,
            'social_expires_in'    => $data->expiresIn,
            'social_refresh_token' => $data->refreshToken,
            'social_token_secret'  => $data->tokenSecret,
        ];
        $profile = Apiato::call('User@UpdateUserTask', [
            $userData,
            Auth::id()
        ]);

        return $profile;
    }
}

?>