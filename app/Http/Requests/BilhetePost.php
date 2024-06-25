<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BilhetePost extends FormRequest
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
            'recibo_id' => 'required',
            'cliente_id' => 'required',
            'sessao_id' => 'required',
            'lugar_id' => 'required',
            'preco_sem_iva' => 'required',
            'estado' => 'required'
        ];
    }
}
