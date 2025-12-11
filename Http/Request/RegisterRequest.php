<?php

namespace Http\Request;

use Core\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email','unique:user,email'],
            'password' => ['required', 'min:8'],
        ];
    }
}