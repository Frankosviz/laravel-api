<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|max:255',
            'type_id' => 'nullable|exists:types,id',
            'description' => 'nullable|min:5|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'url' => 'nullable|url',
            'repository_url' => 'nullable|url',
            'image_path' => 'nullable',
            'status' => 'required',
            // 'slug' => 'nullable'
        ];
    }
    public function messages(){
        return [
            'title.required' => 'This title is required bro!',
            'title.max' => 'Mate.. The title can not be longer than 255 characters',
            'description.min' => 'Can you write more than 4 characters?',
            'description.max' => 'Are you kidding me? The description can not be longer than 255 characters',
            'technologies_used.max' => 'The technologies used can not be longer than 255 characters',
            'end_date.after' => 'This project is too old, mate. It can not be finished before its start date.',
            'status.required' => 'Status is required bro!'
        ];
    }
}
