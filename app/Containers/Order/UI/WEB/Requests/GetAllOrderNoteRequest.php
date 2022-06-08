<?php

namespace App\Containers\Order\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class GetAllOrderNoteRequest.
 */
class GetAllOrderNoteRequest extends Request
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
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

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
    protected $urlParameters = [
        'orderId',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'orderId' => 'required|numeric',
            // '{user-input}' => 'required|max:255',
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

    protected function prepareForValidation()
    {
      $this->merge([
        'order_id' => $this->orderId,
        'id' => $this->orderId
      ]);
    }
}
