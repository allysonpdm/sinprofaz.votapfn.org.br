<?php

namespace App\Rules;

use App\Models\Sinprofaz\Associados;
use Exception;
use Illuminate\Contracts\Validation\Rule;

class IsFiliadoRule implements Rule
{
    protected ?Associados $associado;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
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
        try{
            $this->associado = Associados::where([
                'cpf' => $value,
                'status_filiado' => 1
            ])
            ->orWhere([
                'cpf' => aplicarMascara($value, '###.###.###-##'),
                'status_filiado' => 1
            ])
            ->firstOrFail();

            return $this->associado->exists();
        } catch (Exception $exception){
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.associado.invalido');
    }
}
