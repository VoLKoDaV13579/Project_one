<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecyclerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required',
            'system_id' => 'required|unique:recycler_lists,system_id|max:8|regex:/(^[A-Za-z]{3}\d{5}$)/u ',
            'address' => 'required|max:255',
            'serial_number' => 'required|unique:recycler_lists,serial_number|max:10|regex:/(^[Ss]\d{9}$)/u', 
        ];
    }
}
