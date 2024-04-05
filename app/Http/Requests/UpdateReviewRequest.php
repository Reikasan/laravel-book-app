<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Review;

class UpdateReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $review = Review::findOrFail($this->route('review')->id);
        return $review->user_id == auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'review-rate' => 'nullable|numeric|between:1,5',
            'review-date' => 'nullable|date|before_or_equal:today',
            'review-text' => 'nullable|string|max:5000',
            'is_draft' => 'required|numeric|between:0,1'
        ];
    }
}
