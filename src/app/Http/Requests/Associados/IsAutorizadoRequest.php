<?php

namespace App\Http\Requests\Associados;

use App\Models\Votacoes\Questoes;
use App\Rules\IsFiliadoRule;
use ArchCrudLaravel\App\Rules\CpfRule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class IsAutorizadoRequest extends AssociadosRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'sufragioId' => [
                'bail',
                'required',
                'integer',
                'exists:sufragios,id'
            ],
            'cpf' => [
                'bail',
                'required',
                'digits:11',
                new IsFiliadoRule,
                Rule::unique('participantes', 'cpf')
                    ->where(function($query){
                        $query->where('sufragioId', $this->sufragioId);
                    }),
                new CpfRule(),
            ],
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'Este CPF já participou dessa votação.'
        ];
    }
}
