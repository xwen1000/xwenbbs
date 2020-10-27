<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
        $error= $validator->errors()->all();
        throw new HttpResponseException($this->fail(400, $error));
    }

    protected function fail(int $code, array $errors) : JsonResponse
    {
        return response()->json(
            [
                'code' => $code,
                'errors' => $errors,
            ]
        );
    }
}