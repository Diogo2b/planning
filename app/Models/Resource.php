<?php

namespace App\Models;

use Rakit\Validation\Validator;

class Resource extends Model
{
    protected $table = 'resources';

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
