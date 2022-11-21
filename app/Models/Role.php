<?php

namespace App\Models;

use Rakit\Validation\Validator;

class Role extends Model
{
    protected $table = 'roles';

    static function validate(array $data): array
    {
        $validator = new Validator();
        $validation = $validator->validate($data, [
            'name'                  => 'required',

        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
