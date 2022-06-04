<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-13 13:18:03
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-28 21:27:25
 * @ Description: Happy Coding!
 */


namespace App\Ship\Parents\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends Request
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
