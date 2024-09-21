<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueRestricaoRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        if (!is_array($value)) {
            return true;
        }

        $unique = [];

        foreach ($value as $restricao) {
            $key = $restricao['column'] . '|' . $restricao['value'];
            if (in_array($key, $unique)) {
                return false;
            }
            $unique[] = $key;
        }

        return true;
    }

    public function message()
    {
        return 'As restrições não podem ter combinações duplicadas de coluna e valor.';
    }
}
