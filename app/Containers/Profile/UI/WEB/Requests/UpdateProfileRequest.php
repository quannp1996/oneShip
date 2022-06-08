<?php 
namespace App\Containers\Profile\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

class UpdateProfileRequest extends Request{
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
     * @return  array
     */
    public function rules()
    {
        return [
            'avatar' => 'image',
            'name' => 'required',
            'phone' => 'required',
            'password1' =>'required_with:password|same:password'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => __('validation.profile.name'),
            'phone.required' => __('validation.profile.phone'),
            'password1.same' => __('validation.profile.confirm_password'),
            'password1.required_with' => __('validation.profile.password1'),
            'avatar.image' => __('validation.profile.image'),
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
}
?>