<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRecordsRequest extends FormRequest
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
        $rules = [];

        if ($this->isMethod('post')) {
            // Rules for creating an attendance record
            $rules = [
                'user_id'          => 'required|exists:users,user_id',
                'date'             => 'required|date_format:Y-m-d',
                'time_in'          => 'required|date_format:H:i:s',
                'break_in'         => 'nullable|date_format:H:i:s',
                'break_out'        => 'nullable|date_format:H:i:s',
                'time_out'         => 'nullable|date_format:H:i:s',
                'status'           => 'nullable|string|max:255',
                'break_in_status'  => 'nullable|string|max:255',
                'break_out_status' => 'nullable|string|max:255',
                'time_out_status'  => 'nullable|string|max:255',
                'total_hours'      => 'nullable|numeric|min:0',
            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Rules for updating an attendance record
            $rules = [
                'time_in'          => 'nullable|date_format:H:i:s',
                'break_in'         => 'nullable|date_format:H:i:s',
                'break_out'        => 'nullable|date_format:H:i:s',
                'time_out'         => 'nullable|date_format:H:i:s',
                'status'           => 'nullable|string|max:255',
                'break_in_status'  => 'nullable|string|max:255',
                'break_out_status' => 'nullable|string|max:255',
                'time_out_status'  => 'nullable|string|max:255',
                'total_hours'      => 'nullable|numeric|min:0',
            ];
        }

        return $rules;
    }
}
