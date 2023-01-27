<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class User extends Model
{
    protected $table = 'users';

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
            'email'                   => "required|email|unique:users,email$except",
            'phone_number'            => 'required|numeric',
            'adress'                  => 'required',
            'city'                    => 'required',
            'role_id'                 => "required|integer|exists:roles,id",
            'formation_id'                 => "nullable|integer|exists:formations,id",

        ]);




        $errors = $validation->errors();
        return $errors->firstOfAll();
    }


    public function createUserForm($formation_id)
    {

        // $pdo = $this->db->getPDO();
        // $stmt = $pdo->prepare("INSERT INTO users_formation (user_id, formation_id) VALUES ( (SELECT MAX(id) FROM users), :formation_id)");
        // $stmt->bindParam(':formation_id',$formation_id );
        // $stmt->execute();
    }
}
