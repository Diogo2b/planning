<?php

namespace App\Validation;

use PDO;

use Rakit\Validation\Validator;

class ValidatorFactory
{
    static function createValidator(PDO $pdo): Validator
    {
        $validator = new Validator();
        $validator->addValidator('unique', new UniqueRule($pdo));
        $validator->addValidator('exists', new ExistsRule($pdo));

        return $validator;
    }
}
