<?php

namespace Modules\JwtApi\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Modules\JwtApi\Http\Requests\FailedValidationAble;

class LoginRequest extends FormRequest
{

    use FailedValidationAble;

    public function authorize()
    {
        return auth()->check() == false;
    }

    public function rules()
    {
        return [
            'email'                     => 'required|email|exists:users,email',
            'password'                  => 'required',
        ];
    }

}
