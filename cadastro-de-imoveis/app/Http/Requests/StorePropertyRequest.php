<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyRequest extends FormRequest
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
            'inputTitle' => 'required|max:255|',
            'inputCod' => 'required',
            'inputNumberOfRooms' => 'required|numeric',
            'inputvalue' => 'required',
            'inputConstructionDate' => 'required|date',
            'inputOthers' => 'required',
            'inputCategory' => 'required',
        ];
    }
}
