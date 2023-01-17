<?php

namespace App\Models;

use App\Validation\ValidatorFactory;

class Module extends Model
{
    protected $table = 'modules';
    public function contrainte_heure(): array
    {

        return $this->query("SELECT * FROM {$this->table}  WHERE total_hours>0 AND formation_id = '" . $_POST['event'] . "'  ");
    }

    public function validate(array $data): array
    {
        $validator =  ValidatorFactory::createValidator($this->db->getPDO());

        $validation = $validator->validate($data, [
            'name'                   => 'required',
            'total_hours'           => 'required|integer|between:-1,9999',
            'formation_id'                => 'exists:formations,id'
        ]);
        $errors = $validation->errors();
        return $errors->firstOfAll();
    }
}
