<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Role extends Model
{
    protected $table = 'roles';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [
            'name'                   => 'required|unique:roles,name',
        ]);

        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
