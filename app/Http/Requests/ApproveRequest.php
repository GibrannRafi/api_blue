<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
         'proof' => 'required|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'proof' => 'Bukti Transfer',
        ];
    }
}
