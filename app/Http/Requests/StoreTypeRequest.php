<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
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
            'project_id' => 'nullable|exists:projects,id',
            'name' => 'required|max:200',
            'slug' => 'required|max:255',
            'image_path' => 'nullable',
            'description' => 'nullable|max:255',

        ];
    }

    public function messages(){
        return [
            'name.required' => 'This name is required bro!',
            'name.max' => 'Mate.. The name can not be longer than 255 characters',
            'slug.required' => 'This slug is required brother!',
            'slug.max' => 'Mate.. The slug can not be longer than 255 characters',
            'description.max' => 'Mate.. The description can not be longer than 255 characters',
        ];
    }
}
