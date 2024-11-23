<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if( request()->routeIs('admin.login') ) {
            return [
                'email'         => 'required|string|email|max:255',
                'password'      => 'required|min:8',
            ];
        }
        else if( request()->routeIs('user.login') ) {
            return [
                'email'         => 'required|string|email|max:255',
                'password'      => 'required|min:8',
            ];
        }
        else if( request()->routeIs('user.store') ) {
            return [
                'firstname'         => 'required|string|max:255',
                'lastname'          => 'required|string|max:255',
                'email'             => 'required|string|email|max:255|unique:App\Models\User,email',
                'password'          => 'required|min:8|confirmed',
                'gender'            => 'required',
                'department_id'     => 'integer|nullable|exists:departments,department_id',
                'shift_id'          => 'integer|nullable|exists:shifts,shift_id',
            ];
        }                  
        else if( request()->routeIs('user.update.details')) {
            return [
                'firstname' => 'sometimes|string|max:255',
                'lastname' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,' . $this->route('id') . ',user_id',
                'password' => 'sometimes|nullable|min:8|confirmed',
            ];
        }
        else if( request()->routeIs('user.update')) {
            return [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
            ];
        }
        else if( request()->routeIs('user.email')) {
            return [
                'email'         => 'required|string|email|max:255'
            ];
        }else if( request()->routeIs('user.password')) {
            return [
                'password'      => 'required|confirmed|min:8'
            ];
        }
        else if( request()->routeIs('user.image') || request()->routeIs('profile.image') ) {
            return [
                'image'      => 'required|image|mimes:jpg,bmp,png|max:2048'
            ];
        }
    }
}
