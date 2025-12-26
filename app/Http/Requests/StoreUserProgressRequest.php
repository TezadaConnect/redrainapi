<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProgressRequest extends FormRequest
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
            'id'              => 'required|integer',
            'storyProgressId' => 'required|integer|min:1',
            'level'           => 'required|integer|min:1',
            'experience'      => 'required|integer|min:0',
            'coins'           => 'required|integer|min:0',
            'gems'            => 'required|integer|min:0',
        ];
    }
}
