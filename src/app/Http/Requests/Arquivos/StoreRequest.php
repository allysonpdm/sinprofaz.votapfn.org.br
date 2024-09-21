<?php

namespace App\Http\Requests\Arquivos;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreRequest extends ArquivosRequest
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
        $file = $this->file('file');
        $filename = null;
        $extension = null;

        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->extension();
            $filename = Str::slug(Str::replace('.' . $extension, '', $filename));
        }

        return [
            'sufragioId' => [
                'bail',
                'required',
                'integer',
                'exists:sufragios,id',
                Rule::unique('arquivos')->where(function ($query) use ($filename, $extension) {
                    if ($filename && $extension) {
                        return $query->where('sufragioId', $this->sufragioId)
                                     ->where('filename', $filename . '.' . $extension);
                    }
                    return $query;
                })
            ],
            'label' => 'bail|required|string|min:3|max:50',
            'file' => [
                'bail',
                'required',
                'file',
                'mimetypes:application/pdf',
                'mimes:pdf',
                'max:5000'
            ]
        ];
    }
}
