<?php

namespace App\Containers\Customer\UI\WEB\Rules;

use App\Containers\Customer\Actions\AddressBook\FindCustomerAddressAction;
use Illuminate\Contracts\Validation\Rule;

class CanEditAddressRule implements Rule
{
    public $errorMessage;

    protected $customerID;

    public function __construct($customerID)
    {
        $this->customerID = $customerID;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $customerAddress = app(FindCustomerAddressAction::class)->run($value);
        return $this->customerID == $customerAddress->customerID;
    }   

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
       return 'Bạn không có quyền chỉnh sửa Địa chỉ';
    }
}
