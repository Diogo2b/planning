<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Session extends Model
{
    protected $table = 'sessions';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [

            'start'                  => 'required|integer|between:2021,2100',
            'end'                    => 'required|integer|between:2022,2100',
        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
