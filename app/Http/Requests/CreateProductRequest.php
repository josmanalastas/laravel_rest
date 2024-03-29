<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

/**
 * Class for Create Products request.
 *
 * @since 1.0
 *
 * @version 1.0.0
 */
class CreateProductRequest extends RequestAbstract
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
            "name" => "required|min:7",
            "description" => "required|min:20",
        ];
    }
}
