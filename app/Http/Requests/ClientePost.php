<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientePost extends FormRequest
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
        /*
        $rules="required_with:tipo_pagamento";
        if ($this->tipo_pagamento=='VISA'){
            $rules.="|digits:16";
        }
        if ($this->tipo_pagamento=='PAYPAL'){
            $rules.="|email";
        }
        if ($this->tipo_pagamento=='MBWAY'){
            $rules.="|digits:9|regex:/9[1236][0-9]{7}/";
        }

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->cliente_id,
            'password' => ['sometimes','confirmed',Password::min(8)],

        ];*/
        return [
            //
        ];
    }
}
