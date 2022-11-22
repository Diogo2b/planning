<?php

namespace App\Models;

use Rakit\Validation\Validator;

class Formation extends Model
{
    protected $table = 'formations';

    static function validate(array $data): array
    {
        $validator = new Validator();
        $validation = $validator->validate($data, [
            'name'                  => 'required',
            'season'                => 'required|max:11',
        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
