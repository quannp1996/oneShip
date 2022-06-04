<?php

namespace App\Containers\Order\UI\WEB\Requests;

use App\Ship\core\Traits\HelpersTraits\SecurityTrait;
use App\Ship\Parents\Requests\Request;
use App\Ship\Transporters\DataTransporter;
use App\Containers\User\Models\User;

/**
 * Class StoreOrderNoteRequest.
 */
class StoreOrderNoteRequest extends Request
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
            'title' => 'required|max:255',
            'message' => 'required|min:5'
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
        'title' => $this->cleanXSS($this->title),
        'message' => auth()->user()->name.': '. $this->cleanXSS($this->message),
        'color' => $this->color,
        'order_id' => $this->orderId,
        'object_model' => User::class,
        'object_id' => auth()->id()
      ]);
    }
}
