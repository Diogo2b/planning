<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Resource extends Model
{
    protected $table = 'resource';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [
            'name'                   => 'required|unique:resource,name',

        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
