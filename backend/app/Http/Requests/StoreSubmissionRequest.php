<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSubmissionRequest extends FormRequest
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
            'name' => 'required|string|max:35',
            'email' => 'required|email|max:35',
            'phone' => 'required|string|max:15',
            'message' => 'nullable|string|max:500',
            'file' => 'nullable|file|image|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Ім\'я обов\'язкове',
            'name.max' => 'Ім\'я не може бути довшим за 35 символів',
            'email.required' => 'Email обов\'язковий',
            'email.email' => 'Введіть коректний email',
            'email.max' => 'Email не може бути довшим за 35 символів',
            'phone.required' => 'Телефон обов\'язковий',
            'phone.max' => 'Телефон не може бути довшим за 15 символів',
            'message.max' => 'Повідомлення не може бути довшим за 500 символів',
            'file.file' => 'Файл повинен бути завантажений',
            'file.image' => 'Дозволені тільки зображення',
            'file.max' => 'Розмір файлу не може перевищувати 2MB',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
