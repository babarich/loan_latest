<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'borrower' => 'required',
            'product' => 'required',
            'loan_duration' => 'required',
            'duration_type' => 'required',
            'interest' => 'required',
            'interest_type' => 'required',
            'guarantor' => 'required',
            'principle' => 'required|numeric|gt:0',
            'percent' => 'required|numeric|gt:0',
            'loan_duration' => 'required|numeric|gt:0',
            'number_payments' => 'required|numeric|gt:0'
        ];
    }
}
