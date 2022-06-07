<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-19 21:17:30
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-10-24 20:26:57
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Rules\FrontEnd\AddressBook;

use Illuminate\Contracts\Validation\Rule;

class NewAddressRule implements Rule
{
    protected $msg = '';
    protected $newAddress;

    protected $mustHave = [
        'address','district_id','is_on_working_time','name','phone','province_id','ward_id'
    ];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        sort($this->mustHave);
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
        $sortArr = array_keys($value);
        sort($sortArr);
        if(!in_array($sortArr,[$this->mustHave])) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Dữ liệu không đúng';
    }
}
