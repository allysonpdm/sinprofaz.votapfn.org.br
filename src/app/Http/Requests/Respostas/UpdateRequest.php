<?php

namespace App\Http\Requests\Respostas;

use Illuminate\Validation\Rule;

class UpdateRequest extends RespostasRequest
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
                'max:180',
                Rule::unique('respostas')->where(function ($query) {
                    return $query->where('label', $this->label)
                        ->where('questaoId', $this->questaoId);
                })
            ]
        ];
    }
}
