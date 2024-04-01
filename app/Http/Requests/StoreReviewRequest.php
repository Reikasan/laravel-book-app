<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'book_id' => 'required|exists:books,id',
            'review-rate' => 'nullable|numeric|between:1,5',
            'review-date' => 'nullable|date|before_or_equal:today',
            'review-text' => 'nullable|string|max:5000',
            'is_draft' => 'required|numeric|between:0,1'
        ];
    }
}
