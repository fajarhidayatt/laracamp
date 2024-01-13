<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha'],
            'code' => ['required', 'alpha_num', 'uppercase', 'size:5'],
            'description' => ['nullable'],
            'percentage' => ['required', 'numeric'],
        ];
    }
}
