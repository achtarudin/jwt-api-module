<?php

namespace Modules\JwtApi\Http\Requests;

use Modules\JwtApi\Services\HttpResponseJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidationAble
{
    public function failedValidation(Validator $validator)
    {
        if ($this->isJson()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(HttpResponseJson::error($errors, 'Validation Error', 422));

            throw new HttpResponseException(HttpResponseJson::error($validator->errors(), 'Validation Errors', 422));
        }
        parent::failedValidation($validator);
    }
}
