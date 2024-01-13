<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'exists:users,email'],
            'occupation' => ['nullable'],
            'address' => ['nullable'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,15'],
            'discount' => ['nullable', 'uppercase', 'alpha_num', 'size:5']
        ];
    }
}
