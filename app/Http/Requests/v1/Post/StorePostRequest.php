<?php

namespace App\Http\Requests\v1\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'=>'required|string|max:255',
            'abstract'=>'nullable|string|max:255',
            'body'=>'required|string|min:255|max:2000',
            'category_id'=>'required|int|exists:categories,id',
            'comment' => 'nullable|string',
            'status'=>'required|string'
        ];
    }
}
