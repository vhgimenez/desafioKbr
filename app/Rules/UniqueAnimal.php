<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Pet;

class UniqueAnimal implements Rule
{
    protected $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function passes($attribute, $value)
    {
        // Verifique a unicidade com base nos campos name, age e specie
        return !Pet::where([
            'name' => $this->input['name'],
            'age' => $this->input['age'],
            'specie' => $this->input['specie'],
        ])->exists();
    }

    public function message()
    {
        return 'O animal já existe no banco de dados.';
    }
}
