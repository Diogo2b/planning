<?php

namespace App\Validation;

class Validator
{

    private $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate(array $rules): ?array
    {
        foreach ($rules as $firstname => $rulesArray) {
            if (array_key_exists($firstname, $this->data)) {
                foreach ($rulesArray as $rule) {
                    switch ($rule) {
                        case 'required':
                            $this->required($firstname, $this->data[$firstname]);
                            break;
                        case substr($rule, 0, 3) === 'min':
                            $this->min($firstname, $this->data[$firstname], $rule);
                        default:

                            break;
                    }
                }
            }
        }

        return $this->getErrors();
    }

    private function required(string $firstname, string $value)
    {
        $value = trim($value);

        if (!isset($value) || is_null($value) || empty($value)) {
            $this->errors[$firstname][] = "{$firstname} est requis.";
        }
    }

    private function min(string $firstname, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];

        if (strlen($value) < $limit) {
            $this->errors[$firstname][] = "{$firstname} doit comprendre un minimum de {$limit} caractères";
        }
    }

    private function getErrors(): ?array
    {
        return $this->errors;
    }
}
