<?php

namespace App\Containers\DashBoard\UI\WEB\Requests\Admin;

use App\Ship\Parents\Requests\Request;

/**
 * Class ViewDashboardRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ViewDashboardRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'roles'       => 'admin',
        'permissions' => 'access-dashboard',
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
        return [];
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
