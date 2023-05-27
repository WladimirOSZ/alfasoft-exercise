<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
        $contactId = $this->route('contact') ? $this->route('contact')->id : null;

        return [
            'name' => 'required|min:5|max:255',
            'contact' => [
                'required',
                'digits:9',
                Rule::unique('contacts', 'contact')->ignore($contactId)->whereNull('deleted_at')
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('contacts', 'email')->ignore($contactId)->whereNull('deleted_at')
            ],
        ];

    }

    public function messages(){
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 5 characters',
            'contact.required' => 'Contact is required',
            'contact.digits' => 'Contact must be 9 digits',
            'contact.unique' => 'Contact already exists',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exists',
        ];
    }
}
