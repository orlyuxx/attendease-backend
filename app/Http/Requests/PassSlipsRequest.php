<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassSlipsRequest extends FormRequest
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
            'user_id' => 'required|exists:users,user_id',
            'reason' => 'required|string',
            'time_out' => 'required|date_format:Y-m-d H:i:s',
            'time_in' => 'nullable|date_format:Y-m-d H:i:s',
            'pass_slip_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image required
            'status' => 'nullable|string',
        ];
    }
}
