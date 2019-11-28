<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

/**
 * Class for Login request.
 *
 * @since 1.0
 *
 * @version 1.0.0
 */
class LoginRequest extends RequestAbstract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            "username" => "required",
            "password" => "required"
        ];
    }
}
