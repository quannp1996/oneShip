<?php

namespace App\Containers\Customer\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateContractorRequest.
 */
class UpdatePasswordRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Contractor\Data\Transporters\UpdateContractorTransporter::class;

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
    protected $decode = [
        // 'id',
    ];

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
        return [
            'password' => 'required',
            'password2' => 'required',
            'confirm_password2' => 'required|same:password2'
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return auth('customer')->check();
    }
}
