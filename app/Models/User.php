<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class User extends Model
{
    protected $table = 'users';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $except = '';
        if (isset($data['id'])) {
            $user = $this->findById($data['id']);
            $except = ",$user->email";
        }

        $validation = $validator->validate($data, [
            'lastname'                => 'required',
            'firstname'               => 'required',
            'password'                => 'required|min:3',
            'email'                   => "required|email|unique:users,email$except",
            'phone_number'            => 'required|numeric',
            'adress'                  => 'required',
            'city'                    => 'required',
            'role_id'                 => "required|integer|exists:roles,id",

        ]);

        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
