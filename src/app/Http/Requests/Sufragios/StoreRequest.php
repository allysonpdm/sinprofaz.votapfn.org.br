<?php

namespace App\Http\Requests\Sufragios;

use App\Rules\RestricaoRule;
use App\Rules\UniqueRestricaoRule;

class StoreRequest extends SufragiosRequest
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
            'nome' => 'required|string|min:3|max:180|unique:sufragios',
            'subtitulo' => 'nullable|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'inicio' => 'required|date_format:Y-m-d H:i',
            'fim' => 'required|date_format:Y-m-d H:i',
            'restricoes' => [
                'nullable',
                'array',
                new UniqueRestricaoRule
            ],
            'restricoes.*.column' => 'required_with:restricoes|string|max:255',
            'restricoes.*.value' => 'required_with:restricoes|string|max:255',
        ];
    }
}
