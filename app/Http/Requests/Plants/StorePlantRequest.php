<?php

namespace App\Http\Requests\Plants;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'image_url'    => ['required', 'url'],
            'name'        => ['required', 'string', 'max:255'],
            'information'  => ['required', 'string'],
            'category_ids'    => ['required', 'array'],
            'category_ids.*'  => ['exists:categories,id'],
        ];
    }
}
