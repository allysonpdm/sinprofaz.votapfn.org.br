<?php

namespace App\Http\Requests\Questoes;

use Illuminate\Validation\Rule;

class UpdateRequest extends QuestoesRequest
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
            'label' => [
                'string',
                'min:3',
                'max:255',
                Rule::unique('questoes')->where(function ($query) {
                    return $query->where('label', $this->label)
                        ->where('sufragioId', $this->sufragioId);
                })->ignore($this->input('id'))
            ],
            'complemento' => 'nullable|string|max:1000',
            'limiteEscolhas' => 'required|integer|min:1'
        ];
    }
}
