<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminLoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>'The name should be entered',
            'email.required' =>'The email should be entered',
            'email.email' =>'The email should look like an email',
            'password.required' =>'The password should be entered',
        ];
    }
}
