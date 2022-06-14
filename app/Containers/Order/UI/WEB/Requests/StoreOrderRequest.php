<?php

namespace App\Containers\Order\UI\WEB\Requests;

use App\Ship\core\Traits\HelpersTraits\SecurityTrait;
use App\Ship\Parents\Requests\Request;
use App\Ship\Transporters\DataTransporter;

/**
 * Class StoreOrderRequest.
 */
class StoreOrderRequest extends Request
{
    use SecurityTrait;
    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = DataTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'manage-order',
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
           'customer_id' => ['required'],
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
        'title' => $this->cleanXSS($this->title),
        'message' => $this->cleanXSS($this->message),
        'color' => $this->color,
        'order_id' => $this->orderId,
        'user_id' => auth()->id()
      ]);
    }
}
