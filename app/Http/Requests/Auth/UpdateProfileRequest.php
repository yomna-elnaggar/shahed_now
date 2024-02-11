<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'=>'sometimes|max:50',
            'last_name'=>'max:50',
            'mobile_number'=>'sometimes|regex:/^([0-9\s\-\+\(\)]*)$/|numeric|min:10',
            'email'=>'sometimes',
            'image'=> ['image','mimes:jpg,webp,png,jpeg','max:2048'],
           
        ];
    }
}
