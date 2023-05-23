<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:60|unique:warehouses',
            'location' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'El nombre ya ha sido creado.',
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'Solo se permite maximo 60 caracteres.',
            'location.required' => 'La ubicación es requerida.',
        ];
    }
}
