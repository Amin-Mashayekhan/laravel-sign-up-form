<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
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
            "name" => ['required','min:3','max:190'],
            "email" => ['required','email','min:3','max:190','unique:users,email'],
            "phone_number" => ['required','unique:users,phone_number','regex:/^9[0-9]{9}$/'],
            "introducer_id" => ['nullable'],
            "age" => ['nullable','min:1','max:20000'],
            'password' => ['required', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{6,}$/'],
        ];
    }

    public function attributes()
    {
        return [
            'introducer_id' => 'کد معرف',
            "password" => 'رمز عبور',
            "phone_number" => "شماره تلفن همراه",
        ];
    }
}
