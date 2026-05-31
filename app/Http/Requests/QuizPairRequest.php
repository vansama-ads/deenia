<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizPairRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'left_text' => 'required|string',
            'right_text' => 'required|string',
        ];
    }
}
