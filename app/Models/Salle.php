<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Salle extends Model
{
    protected $table = 'salles';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [
            'name'                   => 'required',

            'site'                => 'exists:sites,id'
        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
