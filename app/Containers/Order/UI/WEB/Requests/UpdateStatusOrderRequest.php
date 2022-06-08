<?php

namespace App\Containers\Order\UI\WEB\Requests;

use App\Containers\User\Models\User;
use App\Ship\Parents\Requests\Request;

/**
 * Class ExportOrderRequest.
 */
class UpdateStatusOrderRequest extends Request
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

    protected $noteKey = [
        'action_key' => 'accept',
        'note' => 'Tiếp nhận đơn hàng'
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
        'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'id' => 'required',
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
      $user = auth()->user();
      $this->merge(array_merge([
        'user_id' => 0, // Không có ai tiếp nhận
        'username' => $user->username ?? '',
        'object_model' => User::class,
        'object_id' => $user->id,
        'ip' => request()->ip(),
      ],$this->noteKey));
    }
} // End class
