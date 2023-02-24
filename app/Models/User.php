<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class User extends Model
{
    protected $table = 'user';

    public function getByEmail(string $email): User|bool
    {
        return $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$email], true);
    }






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
            'email'                   => "required|email|unique:user,email$except",
            'phone_number'            => 'required|numeric',
            'adress'                  => 'required',
            'city'                    => 'required',
            'role_id'                 => "required|integer|exists:role,id",
            'formation_id'                 => "nullable|integer|exists:formation,id",

        ]);




        $errors = $validation->errors();
        return $errors->firstOfAll();
    }

}
