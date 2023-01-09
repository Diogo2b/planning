<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Module extends Model
{
    protected $table = 'modules';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [
            'name'                   => 'required',
            'total_hours'           => 'required|integer|between:-1,2000',

            'user_id'                => 'exists:users,id'
        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
