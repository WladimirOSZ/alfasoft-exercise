<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
        'name' => 'required|min:5|max:255',
        'contact' => 'required|digits:9',
        'email' => 'required|email|max:255|unique:contacts,email,NULL,id,deleted_at,NULL',
    ];
}

    public function messages(){
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 5 characters',
            'contact.required' => 'Contact is required',
            'contact.digits' => 'Contact must be 9 digits',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exists',
        ];
    }
}
