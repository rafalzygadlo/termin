<?php

namespace Http\Request;

use Core\Request;

class RegisterRequest extends Request
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return 
        [
            'email' => ['required', 'email','unique:user,email'],
            'password' => ['required', 'min:8'],
        ];
    }
}