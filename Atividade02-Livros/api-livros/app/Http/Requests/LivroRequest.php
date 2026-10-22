<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $obrigatorio = $this->isMethod('post') ? 'required' : 'sometimes|required';

        return [
            'titulo'         => "$obrigatorio|string|max:255",
            'autor'          => "$obrigatorio|string|max:255",
            'ano_publicacao' => 'nullable|integer|min:1000|max:' . date('Y'),
        ];
    }
}
