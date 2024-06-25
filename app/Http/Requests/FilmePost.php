<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titulo' => 'required',
            'genero_code' => 'required|exists:generos,code',
            'ano' => 'required|integer|digits:4',
            'cartaz_url' => 'nullable|image|max:8192',
            'sumario' => 'required',
            'trailer_url' => 'nullable'

        ];
    }
}
