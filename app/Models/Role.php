<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Role extends Model
{
    protected $table = 'role';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [
            'name'                   => 'required|unique:role,name',
        ]);

        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
