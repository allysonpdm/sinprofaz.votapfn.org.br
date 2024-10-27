<?php

namespace App\Http\Requests\Sufragios;

use App\Rules\BelongsToQuestaoRule;
use App\Rules\HorarioEleitoralRule;
use App\Rules\IsFiliadoRule;
use ArchCrudLaravel\App\Rules\CpfValidationRule;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class ComprovanteRequest extends SufragiosRequest
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
            'cpf' => [
                'bail',
                'required',
                'digits:11',
                new IsFiliadoRule,
                Rule::exists('participantes', 'cpf')
                    ->where(function ($query) {
                        $query->where('sufragioId', $this->sufragioId);
                    }),
                new CpfValidationRule(),
            ],
            'nome' => 'bail|required|string',
            'sufragioId' => [
                'bail',
                'required',
                'integer',
                'exists:sufragios,id',
                new HorarioEleitoralRule($this->sufragioId)
            ],
            'questoes' => 'bail|nullable|array',
            'questoes.*.id' => [
                'bail',
                'integer',
                Rule::exists('questoes', 'id')->where(function ($query) {
                    $query->where('sufragioId', $this->sufragioId);
                }),
            ],
            'questoes.*.respostas' => [
                'bail',
                'required_with:questoes',
                'array',
            ],
            'questoes.*.respostas.*.id' => [
                'bail',
                'required_if:questoes,*',
                'integer',
                'exists:respostas,id',
                new BelongsToQuestaoRule($this->questoes),
            ]
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'Este CPF já participou dessa votação.'
        ];
    }
}
