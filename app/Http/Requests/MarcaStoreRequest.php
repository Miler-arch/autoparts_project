<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaStoreRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:50|unique:marcas',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'El nombre ya ha sido creado.',
            'name.required' => 'El nombre es requerido.',
            'name.regex' => 'Solo se permite texto.',
            'name.max' => 'Solo se permite maximo 70 caracteres.',
        ];
    }
}
