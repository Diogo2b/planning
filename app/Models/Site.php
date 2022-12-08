<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Site extends Model
{
    protected $table = 'sites';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [
            'name'                   => 'required',

        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
