<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|string|max:100|unique:tasks',
            'content' => 'required|string',
            'status' => 'required|in:to_do,in_progress,done',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096', // Adjust max file size as needed
        ];
    }
}