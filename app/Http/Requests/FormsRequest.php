<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required'],
            'pet'=>['required'],
            'email'=>['required', 'email', 'unique:users,email'],
            'cpf'=>['required'],
            'telephone'=>['required', 'regex:/^\d{10,11}$/'],
            'date_birth'=>['required'],
            'g-recaptcha-response' => 'required|captcha'
        ];
    }
}
