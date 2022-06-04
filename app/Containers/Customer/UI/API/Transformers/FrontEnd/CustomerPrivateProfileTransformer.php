<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-18 15:28:43
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 15:35:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Transformers\FrontEnd;

use Apiato\Core\Foundation\ImageURL;
use App\Containers\Customer\Models\Customer;
use App\Ship\Parents\Transformers\Transformer;
use App\Containers\Bizfly\Actions\Loyalty\FindCustomerLoyaltyAction;

class CustomerPrivateProfileTransformer extends Transformer
{
    protected array $availableIncludes = [];

    protected array $defaultIncludes = [];

    public function transform(Customer $user)
    {
        $customer = Customer::where('id', $user->id)->first();
        $eshopCus=app(FindCustomerLoyaltyAction::class)->run($customer);
        $response = [
            'object'               => 'Customer',
            'id'                   => $user->id,
            'name'                 => $user->fullname,
            'email'                => $user->email,
            'phone'                => $user->phone,
            'gender'               => $user->gender,
            'birth'                => $user->birth_date,
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
            'membership_point' => $eshopCus->response['data']['membership_point'] ?? 0,
            'point_rate' => $eshopCus->response['data']['rank_info']['point_rate'] ?? 1,
            'point_value' => $eshopCus->response['data']['rank_info']['point_value'] ?? 1,
        ];
        return $response;
    }
}
