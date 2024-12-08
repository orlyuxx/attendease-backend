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
        if( request()->routeIs('attendance.store') ) {
            return [
                'user_id'          => 'required|exists:users,user_id',
                'date'             => 'required|date_format:Y-m-d',
                'time_in'          => 'nullable|date_format:H:i:s',
                'break_in'         => 'nullable|date_format:H:i:s',
                'break_out'        => 'nullable|date_format:H:i:s',
                'time_out'         => 'nullable|date_format:H:i:s',
                'status'           => 'nullable|string|max:255',
                'break_in_status'  => 'nullable|string|max:255',
                'break_out_status' => 'nullable|string|max:255',
                'time_out_status'  => 'nullable|string|max:255',
            ];
        }
        else if( request()->routeIs('attendance.update') ) {
            return [
                'status'           => 'nullable|string|max:255',
                'break_in'         => 'nullable|date_format:H:i:s',
                'break_out'        => 'nullable|date_format:H:i:s',
                'time_out'         => 'nullable|date_format:H:i:s',
                'break_in_status'  => 'nullable|string|max:255',
                'break_out_status' => 'nullable|string|max:255',
                'time_out_status'  => 'nullable|string|max:255',
            ];
        }

    }
}
