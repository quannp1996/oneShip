<?php

namespace App\Containers\ShippingUnit\UI\API\Requests\FrontEnd;

use App\Ship\Parents\Requests\Request;

/**
 * Class CaculateShippingFeesRequest.
 */
class CaculateShippingFeesRequest extends Request
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
        return [
            'package.weight' => ['required'],
            'sender.ward_id' => ['required'],
            'sender.province_id' => ['required'],
            'sender.district_id' => ['required'],
            'receiver.province_id' => ['required'],
            'receiver.district_id' => ['required'],
            'receiver.ward_id' => ['required']
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }
}
