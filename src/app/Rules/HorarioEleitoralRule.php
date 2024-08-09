<?php

namespace App\Rules;

use App\Models\Votacoes\Sufragios;
use Exception;
use Illuminate\Contracts\Validation\Rule;

class HorarioEleitoralRule implements Rule
{
    protected ?Sufragios $sufragio;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(public ?int $sufragioId)
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
            if(empty($this->sufragioId)){
                return false;
            }

            $now = date('Y-m-d H:i:s');
            $this->sufragio = Sufragios::where(['id' => $this->sufragioId])->firstOrFail();
            return $this->sufragio->inicio <= $now && $this->sufragio->fim >= $now;
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
        return trans(
            'validation.sufragio.horario',
            [
                'inicio' => date('d/m/Y \á\s H:i:s', strtotime($this->sufragio->inicio)),
                'fim' => date('d/m/Y \á\s H:i:s', strtotime($this->sufragio->fim))
            ]);
    }
}
