<?php

namespace App\Containers\Contact\UI\API\Requests;

use App\Containers\Contact\UI\API\Rule\FormRule;
use App\Containers\Field\Actions\GetAllFieldsAction;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateContactRequest.
 */
class CreateContactRequest extends Request
{

    protected $field;

    public function __construct()
    {
        $this->fields = app(GetAllFieldsAction::class)->run([
            'status' => '1',
            'is_required' => '1'
        ]);
    }
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
        // 'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        $baseRule = [
            'shop_name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'regex:/(0)[0-9]{9}/'],
        ];

        foreach($this->fields AS $field){
            $baseRule['field.'. $field->id] = 'required';
        }

        return $baseRule;
    }

    public function messages()
    {
        $baseMessage = [
            'shop_name.required' => 'Tên Shop là trường bắt buộc',
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Số điện thoại là trường bắt buộc',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
        ];
        foreach($this->fields AS $field){
            $baseMessage['field.'. $field->id. '.required'] =  $field->lable. ' là trường bắt buộc';
        }

        return $baseMessage;
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
