<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeavesRequest extends FormRequest
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
        // Default rules for other methods
        return [
            'user_id'        => 'required|exists:users,user_id',
            'leave_start'    => 'required|date|before_or_equal:leave_end',
            'leave_end'      => 'required|date|after_or_equal:leave_start',
            'reason'         => 'required|string|max:255',
            'number_of_days' => 'required|integer|min:1',
            'leave_type_id'  => 'required|exists:leave_types,leave_type_id',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }
}
