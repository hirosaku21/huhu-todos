<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            'content' => ['required', 'max:100'],
            'category_id' => ['required', 'exists:categories,id'],
            'sharing_range' => ['required', 'in:share,personal']
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'タスクを入力してください',
            'content.max' => 'タスクは100文字以内で入力してください',
            'category_id.required' => 'カテゴリーを選択してください',
            'sharing_range.required' => '共有範囲を選択してください'
        ];
    }
}
