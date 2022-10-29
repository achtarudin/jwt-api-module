<?php

namespace Modules\JwtApi\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Modules\JwtApi\Http\Requests\FailedValidationAble;

class RegistrationRequest extends FormRequest
{
    use FailedValidationAble;

    public function authorize()
    {
        return !auth()->check();
    }

    public function rules()
    {

        return [
            'name'                      => 'required|min:2|max:255',
            'email'                     => 'required|email|unique:users,email',
            'password'                  => 'required|min:6',
        ];
    }


}
