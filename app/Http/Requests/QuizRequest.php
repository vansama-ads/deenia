<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'act_id' => 'required|exists:acts,id',
            'title' => 'required|string|max:255',
        ];
    }
}
