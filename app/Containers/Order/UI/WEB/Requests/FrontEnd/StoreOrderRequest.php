<?php

namespace App\Containers\Order\UI\WEB\Requests\FrontEnd;

use App\Ship\Parents\Requests\Request;

/**
 * Class AcceptOrderRequest.
 */
class StoreOrderRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    // protected $transporter = \App\Ship\Transporters\DataTransporter::class;

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
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [

    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'sender.fullname' => ['required'],
            'sender.phone' => ['required'],
            'sender.province_id' => ['required'],
            'sender.district_id' => ['required'],
            'sender.ward_id' => ['required'],
            'sender.address1' => ['required'],
            'receiver.fullname' => ['required'],
            'receiver.phone' => ['required'],
            'receiver.province_id' => ['required'],
            'receiver.district_id' => ['required'],
            'receiver.ward_id' => ['required'],
            'receiver.address1' => ['required'],
            'package.weight' => ['required'],
            'shipping.cod' => ['required', 'min:0']
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
} // End class
