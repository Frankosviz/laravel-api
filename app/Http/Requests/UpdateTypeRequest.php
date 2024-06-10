<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
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
            'project_id' => 'required|exists:types,id',
            'name' => 'required|max:200',
            'slug' => 'max:255',
            'description' => 'nullable|max:255',
            'image_path' => 'nullable',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'This name is required bro!',
            'name.max' => 'Mate.. The name can not be longer than 255 characters',
            'description.max' => 'The description can not be longer than 255 characters',
            'slug.max' => 'The slug can not be longer than 255 characters',
            'image_path.max' => 'The image path can not be longer than 255 characters',
        ];
    }
}
