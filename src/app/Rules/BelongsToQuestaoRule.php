<?php

namespace App\Rules;

use App\Models\Votacoes\Respostas;
use Illuminate\Contracts\Validation\Rule;

class BelongsToQuestaoRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(protected ?array $questoes)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($value === null) {
            return true;
        }

        $s = explode('.', $attribute);
        $key = $s[1];
        return  Respostas::find($value)->questao->id == $this->questoes[$key]['id'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.sufragio.belongsTo');
    }
}
