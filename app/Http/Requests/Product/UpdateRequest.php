<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|unique:products', 
            'code' => 'nullable|string|max:8|min:8',
            'codigo' => 'required|max:30',
            'price' => 'required|numeric',
            'stock' => 'nullable|numeric',
            'image' => 'nullable|image',
            'category_id' => 'required|integer|exists:categories,id',
            'provider_id' => 'required|integer|exists:providers,id',
            'marca_id' => 'required|integer|exists:marcas,id',
            'medida_id' => 'required|integer|exists:medidas,id',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requirido',
            'name.unique' => 'El nombre ya existe',
            'codigo.required' => 'El Código es requirido',
            'codigo.max' => 'Solo se permite 30 caracteres',
            'price.required' => 'El Precio es requirido',
            'price.numeric' => 'Solo se permite números',
            'stock.numeric' => 'Solo se permite números',
            'category_id.required' => 'La categoría es requirida',
            'category_id.integer' => 'La categoría es requirida',
            'category_id.exists' => 'La categoría es requirida',
            'provider_id.required' => 'El proveedor es requirido',
            'provider_id.integer' => 'El proveedor es requirido',
            'provider_id.exists' => 'El proveedor es requirido',
            'marca_id.required' => 'La marca es requirida',
            'marca_id.integer' => 'La marca es requirida',
            'marca_id.exists' => 'La marca es requirida',
            'medida_id.required' => 'La medida es requirida',
            'medida_id.integer' => 'La medida es requirida',
            'medida_id.exists' => 'La medida es requirida', 
        ];
    }
}
