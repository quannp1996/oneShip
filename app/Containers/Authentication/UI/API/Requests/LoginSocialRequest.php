<?php

namespace App\Containers\Authentication\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Arr;

/**
 * Class LoginRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LoginSocialRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => null,
        'roles' => null,
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [

    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'social_id' => ['required'],
            'social_name' => ['required'],
            'social_provider' => ['required'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
