<?php

namespace App\Models;

use Rakit\Validation\Validator;

class User extends Model
{
    protected $table = 'users';

    static function validate(array $data): array
    {
        $validator = new Validator();
        $validation = $validator->validate($data, [
            'lastname'                => 'required',
            'firstname'               => 'required',
            'password'                => 'required|min:3',
            'email'                   => 'required|email',
            'phone_number'            => 'required|numeric',
            'adress'                  => 'required',
            'city'                    => 'required',

        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
