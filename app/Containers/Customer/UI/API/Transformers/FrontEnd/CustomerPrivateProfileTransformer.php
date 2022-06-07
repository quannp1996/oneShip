<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-18 15:28:43
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-18 15:35:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Transformers\FrontEnd;

use Apiato\Core\Foundation\ImageURL;
use App\Containers\Customer\Models\Customer;
use App\Ship\Parents\Transformers\Transformer;

class CustomerPrivateProfileTransformer extends Transformer
{
    protected array $availableIncludes = [];

    protected array $defaultIncludes = [];

    public function transform(Customer $user)
    {
        $response = [
            'object'               => 'Customer',
            'id'                   => $user->id,
            'name'                 => $user->fullname,
            'email'                => $user->email,
            'province'             => $user->province,
            'district'             => $user->district,
            'ward'                 => $user->ward,
            'phone'                => $user->phone,
            'gender'               => $user->gender,
            'genderText'           => $user->gender,
            'address'              => $user->address,
            'date_of_birth'        => $user->date_of_birth,
            'avatar'               => ImageURL::getImageUrl($user->avatar, 'customer', 'avatar'),
            'social_auth_provider' => $user->social_provider,
            'social_id'            => $user->social_id,
            'social_avatar'        => [
                'avatar'   => $user->social_avatar,
                'original' => $user->social_avatar_original,
            ],
            'created_at'           => $user->created_at,
            'updated_at'           => $user->updated_at,
            'readable_created_at'  => $user->created_at,
            'readable_updated_at'  => $user->updated_at,
            'authenticated' => true,
        ];

        return $response;
    }
}
