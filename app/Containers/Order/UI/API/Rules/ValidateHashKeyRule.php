<?php

namespace App\Containers\Order\UI\API\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateHashKeyRule implements Rule
{
    public $errorMessage;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->errorMessage = __('Hash Key không đúng');
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
        // return $value == config('app.key') && request()->ip() == '';
        return $value == config('app.key');
    }   

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }
}
