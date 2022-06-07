<?php

namespace App\Containers\Customer\UI\WEB\Requests;

use App\Ship\core\Traits\HelpersTraits\SecurityTrait;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateCustomerRequest.
 */
class SendOtpCustomerRequest extends Request
{
    use SecurityTrait;
    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    // protected $transporter = \App\Containers\Customer\Data\Transporters\::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [];

    /**
     * @return  array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return auth('customer')->check();
    }
}
