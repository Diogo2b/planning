<?php

namespace App\Models;

use Rakit\Validation\Validator;

class Module extends Model
{
    protected $table = 'modules';

    static function validate(array $data): array
    {
        $validator = new Validator();
        $validation = $validator->validate($data, [
            'name'                  => 'required',
            'total_hours'           => 'required|integer|between:1,2000',
        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
