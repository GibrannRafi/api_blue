<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyerUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_picture' => 'nullable|image|mimes:jpg,png',
            'phone_number' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [
           'profile_picture' => ' Avatar',
            'phone_number' => 'Nomor HP'
        ];
    }
}
