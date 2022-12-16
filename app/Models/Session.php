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

            'start'                  => 'required',
            'end'                    => 'required',
            'salle_id'                => 'exists:salles,id',
            'user_id'                => 'exists:users,id',
            'formation_id'                => 'exists:formations,id',
            'module_id'                => 'exists:modules,id',

        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
