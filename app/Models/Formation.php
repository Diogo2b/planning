<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Formation extends Model
{
    protected $table = 'formations';

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [
            'name'                   => 'required',
            'season'                => 'required|max:11',
            'site'                => 'exists:site,id'
        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
