<?php

namespace App\Http\Requests\Respostas;

use Illuminate\Support\Facades\Gate;

class ShowRequest extends RespostasRequest
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
        return $this->indexRequest();
    }
}
